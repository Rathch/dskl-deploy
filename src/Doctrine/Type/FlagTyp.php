<?php
namespace App\Doctrine\Type;

use App\Doctrine\Enum\Flag;

class FlagTyp extends AbstractEnumTyp
{
    public const NAME = 'flag';

    public function getName(): string // the name of the type.
    {
        return self::NAME;
    }

    public static function getEnumsClass(): string // the enums class to convert
    {
        return Flag::class;
    }
}