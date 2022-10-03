<?php
namespace App\Doctrine\Type;

use App\Doctrine\Enum\Position;

class PositionTyp extends AbstractEnumTyp
{
    public const NAME = 'position';

    public function getName(): string // the name of the type.
    {
        return self::NAME;
    }

    public static function getEnumsClass(): string // the enums class to convert
    {
        return Position::class;
    }
}