<?php

declare(strict_types=1);

namespace Fixture\Generator\Models;

use Spatie\DataTransferObject\DataTransferObject;

class Primitive extends DataTransferObject
{
    public bool $bool;
    public int $int;
    public int $intWithDefault = 7;
    public float $float;
    public float $floatWithDefault = 0.0;
    public string $string;
    public array $array;
    public object $object;
    public ?bool $nullable;
    public ?int $nullableDefault = null;
}
