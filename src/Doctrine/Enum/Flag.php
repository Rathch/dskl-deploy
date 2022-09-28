<?php
namespace App\Doctrine\Enum;



enum Flag: string
{
    case Active = 'Active';
    case Inactive = 'Inactive';
    case Deleted = 'Deleted';
}
