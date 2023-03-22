<?php

declare(strict_types=1);

namespace Fixture\Generator;

use DateTime;
use DateTimeZone;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;
use stdClass;

trait HasFixtureGenerator
{
    private array $generatedDataSet = [];
    private ReflectionClass $classReflection;

    /**
     * @throws ReflectionException
     */
    public function generate(string $className, bool $isComplete = true, array $providedData = []): mixed
    {
        $specificObject = $this->generateSpecificObject($className);
        if ($specificObject) {
            return $specificObject;
        }

        $this->classReflection = (new ReflectionClass($className));
        $properties = $this->classReflection->getProperties();

        foreach ($properties as $property) {
            $propertyReflection = new ReflectionProperty($className, $property->getName());

            if ($propertyReflection->hasDefaultValue()) {
                continue;
            }

            if (!$isComplete && $propertyReflection->getType()->allowsNull()) {
                $this->generatedDataSet[$property->getName()] = null;
                continue;
            }

            if ($providedData && array_key_exists($property->getName(), $providedData)) {
                $this->generatedDataSet[$property->getName()] = $providedData[$property->getName()];
                continue;
            }

            $propertyType = $propertyReflection->getType()->getName();

            $this->generatedDataSet[$property->getName()] = match ($propertyType) {
                'string' => "The {$propertyReflection->getName()}",
                'bool' => true,
                'int' => 0,
                'float' => 3.14,
                'array' => ['key' => 'value'],
                'object' => $this->getStdClass(),
                'timestamp' => 314159,
                default => $this->generate($propertyType),
            };
        }


        $this->cleanUp();

        return new $className($this->generatedDataSet);
    }

    private function getStdClass(): stdClass
    {
        $stdClass = new stdClass();
        $stdClass->id = 1;
        return $stdClass;
    }

    private function cleanUp(): void
    {
        foreach ($this->generatedDataSet as $kay => $value) {
            if (is_object($value) && method_exists($value, 'toArray')) {
                $this->generatedDataSet[$kay] = $value->toArray();
            }

            if ($this->classReflection->getParentClass() && in_array($kay, $this->classReflection->getParentClass()->getProperties())) {
                unset($this->generatedDataSet[$kay]);
            }
        }
    }

    private function generateSpecificObject(string $className): DateTimeZone|DateTime|null
    {
        return match ($className) {
            'DateTimeZone' => new DateTimeZone('Europe/Berlin'),
            'DateTime' => new DateTime('2023-03-16T20:00:00+01:00'),
            default => null,
        };
    }
}
