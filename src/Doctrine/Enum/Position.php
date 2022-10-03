<?php
namespace App\Doctrine\Enum;



enum Position: string
{
    case scout = 'Scout';
    case hunter = 'Jäger';
    case breacher = 'Brecher';
    case shooter = 'Schütze';
    case attaker = 'Stürmer';
    case sani = 'Sani';
}