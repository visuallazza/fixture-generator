<?php

declare(strict_types=1);

namespace Fixture\Generator\Models;

use DateTime;
use DateTimeZone;
use Spatie\DataTransferObject\DataTransferObject;

class DateTimeObject extends DataTransferObject
{
    public DateTimeZone $dateTimeZone;
    public DateTime $dateTime;
}
