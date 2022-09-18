<?php

namespace App\Utility;

final class StringUtility
{

    /**
     * @var string[]
     */
    private const SEARCH = array(
        'Ä',
        'Ö',
        'Ü',
        'ä',
        'ö',
        'ü',
        'é',
    );

    /**
     * @var string[]
     */
    private const REPLACE = array(
        'Ae',
        'Oe',
        'Ue',
        'ae',
        'oe',
        'ue',
        'e',
    );

    public static function removeSpecialCharacter($string): string
    {
        $string = str_replace(' ', '-', $string);
        return preg_replace('#[^A-Za-z0-9\-]#', '', $string);
    }

    private static function replaceSpecialCars($stringToClean): string|array
    {
        return str_replace(self::SEARCH, self::REPLACE, $stringToClean);
    }

    public static function prepareStringForUrl($stringToClean): string
    {
        $stringToClean = StringUtility::replaceSpecialCars($stringToClean);
        $stringToClean = str_replace(".", "", $stringToClean);
        $stringToClean = strtolower($stringToClean);
        $stringToClean = trim($stringToClean);
        return StringUtility::removeSpecialCharacter($stringToClean);

    }

    public static function prapereFileName($stringToClean): string
    {
        $stringToClean = StringUtility::replaceSpecialCars($stringToClean);
        $stringToClean = strtolower($stringToClean);
        $stringToClean = trim($stringToClean);
        return str_replace("-br+pl", "", $stringToClean);
    }
}