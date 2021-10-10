<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ReactionType extends Enum
{
    const LIKE = "LIKE";
    const DISLIKE = "DISLIKE";
    const LOVE = "LOVE";
    const SAD = "SAD";
    const HAHA = "HAHA";
}
