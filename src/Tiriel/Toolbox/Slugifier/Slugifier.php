<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 09/11/16
 * Time: 15:58
 */

namespace Toolbox\Slugifier;


class Slugifier
{
    public static function slugify($string)
    {
        $aArray = array('à', 'â', 'ä');
        $eArray = array('é', 'è', 'ê', 'ë');
        $iArray = array('î', 'ï');
        $oArray = array('ô', 'ö');
        $uArray = array('ù');

        $string = trim($string);
        $string = strtolower($string);
        $string = str_replace($aArray, 'a', $string);
        $string = str_replace($eArray, 'e', $string);
        $string = str_replace($iArray, 'i', $string);
        $string = str_replace($oArray, 'o', $string);
        $string = str_replace($uArray, 'u', $string);

        $string = preg_replace('/\W+/', '-', $string);

        return $string;
    }
}