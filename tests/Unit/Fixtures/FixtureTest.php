<?php

declare(strict_types=1);

namespace Unit\Fixtures;

use DateTime;
use DateTimeZone;
use Fixture\Generator\HasFixtureGenerator;
use Fixture\Generator\Models\DateTimeObject;
use Fixture\Generator\Models\Nested;
use Fixture\Generator\Models\Primitive;
use PHPUnit\Framework\TestCase;

class FixtureTest extends TestCase
{
    use HasFixtureGenerator;

    public function testGeneratePrimitive(): void
    {
        $primitive = new Primitive([
            'bool' => false,
            'int' => 1,
            'float' => 13.45,
            'string' => 'The string',
            'array' => [0, 1, 2],
            'object' => new \stdClass(),
        ]);

        $generated = $this->generate(Primitive::class);
        $this->assertInstanceOf(Primitive::class, $generated);

        $this->assertIsBool($generated->bool);
        $this->assertTrue($generated->bool);
        $this->assertNotNull($generated->nullable);
        $this->assertIsint($generated->int);
        $this->assertIsFloat($generated->float);
        $this->assertIsString($generated->string);
        $this->assertIsArray($generated->array);
        $this->assertIsObject($generated->object);

        $this->assertEquals($primitive->intWithDefault, $generated->intWithDefault);
        $this->assertEquals($primitive->floatWithDefault, $generated->floatWithDefault);
        $this->assertNull($generated->nullableDefault);
    }

    public function testGeneratePrimitiveWithRequiredProperties(): void
    {
        $generatedObject = $this->generate(Primitive::class, false);
        $this->assertInstanceOf(Primitive::class, $generatedObject);
        $this->assertNull($generatedObject->nullable);
    }

    public function testGeneratePartialPrimitiveWithRequiredProperties(): void
    {
        $generatedObject = $this->generate(
            Primitive::class,
            true,
            [
                'int' => 15,
            ]
        );
        $this->assertInstanceOf(Primitive::class, $generatedObject);
        $this->assertEquals(15, $generatedObject->int);
    }

    public function testGenerateNested(): void
    {
        $generated = $this->generate(Nested::class);
        $this->assertInstanceOf(Nested::class, $generated);
    }

    public function testGenerateDateTimeObject(): void
    {
        $generated = $this->generate(DateTimeObject::class);
        $this->assertInstanceOf(DateTimeObject::class, $generated);
        $this->assertInstanceOf(DateTimeZone::class, $generated->dateTimeZone);
        $this->assertInstanceOf(DateTime::class, $generated->dateTime);
    }
}
