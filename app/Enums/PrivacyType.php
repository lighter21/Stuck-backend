<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PrivacyType extends Enum
{
    const PRIVATE = "PRIVATE";
    const PUBLIC = "PUBLIC";
    const FRIENDS = "FRIENDS";
}
