<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class InvitationType extends Enum
{
    const FRIEND =   "FRIEND";
    const GROUP =   "GROUP";
    const EVENT =   "EVENT";
}
