<?php
namespace App\Doctrine\Type;

use App\Doctrine\Enum\MethaTyp;

class MethaTypTyp extends AbstractEnumTyp
{
    final public const NAME = 'methaTyp';

    public function getName(): string // the name of the type.
    {
        return self::NAME;
    }

    public static function getEnumsClass(): string // the enums class to convert
    {
        return MethaTyp::class;
    }
}