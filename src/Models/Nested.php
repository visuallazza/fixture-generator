<?php

declare(strict_types=1);

namespace Fixture\Generator\Models;

use Spatie\DataTransferObject\DataTransferObject;

class Nested extends DataTransferObject
{
    public Primitive $primitive;
}
