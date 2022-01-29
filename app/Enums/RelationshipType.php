<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RelationshipType extends Enum
{
    const FRIEND =    "FRIEND";
    const COUPLE =    "COUPLE";
    const IGNORED =   "IGNORED";
}
