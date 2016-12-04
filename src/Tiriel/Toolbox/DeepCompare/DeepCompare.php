<?php

/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 03/12/16
 * Time: 13:24
 */

namespace Toolbox\DeepCompare;

class DeepCompare
{
    /**
     * Deep recursive comparison tool.
     * Function ca be used as basis for comparison and update tool. Un-static function and add updating tools (setters)
     *
     * @param $var1
     * @param $var2
     * @return bool
     */
    public static function compare($var1, $var2)
    {
        // If both vars are objects
        if (is_object($var1) && is_object($var2)) {
            return self::compareObject($var1, $var2);
        }
        // If both vars are arrays
        if (is_array($var1) && is_array($var2)) {
            return self::compareArray($var1, $var2);
        }
        // Compare scalar values
        return self::compareScalar($var1, $var2);
    }

    /**
     * @param $var1
     * @param $var2
     * @return bool
     */
    public static function compareArray($var1, $var2)
    {
        if ($error= !is_array($var1) || !is_array($var2)) {
            list($var, $type) = $error ? array(1, gettype($var1)) : array(2, gettype($var2));
            throw new \InvalidArgumentException("Both variables must be arrays ({$type} given at parameter {$var}).");
        }
        // While array continues
        while (!is_null(key($var1)) && !is_null(key($var2))) {
            // Compare keys and values
            if (key($var1)!==key($var2) || !self::compare(current($var1), current($var2))) {
                return false;
            }
            // Move forward in array
            next($var1); next($var2);
        }
        // If array was parsed without returning false
        return is_null(key($var1)) && is_null(key($var2));
    }

    /**
     * @param $var1
     * @param $var2
     * @return bool
     */
    public static function compareObject($var1, $var2)
    {
        if ($error = !is_array($var1) || !is_array($var2)) {
            list($var, $type) = $error ? array(1, gettype($var1)) : array(2, gettype($var2));
            throw new \InvalidArgumentException("Both variables must be objects ({$type} given at parameter {$var}).");
        }
        // Compare classes
        if (get_class($var1) !== get_class($var2)) {
            return false;
        }
        // Retrieve properties
        $refVar = new \ReflectionClass($var1);
        // Parse properties
        foreach($refVar->getProperties() as $property) {
            $property->setAccessible(true);
            $getter = 'get'.ucfirst($property->getName());
            // Compare properties values
            if(!self::compare($var1->$getter(), $var2->$getter()))
                return false;
        }
        return true;
    }

    /**
     * @param $var1
     * @param $var2
     * @return bool
     */
    public static function compareScalar($var1, $var2)
    {
        if ($error = !is_scalar($var1) || !is_scalar($var2)) {
            list($var, $type) = $error ? array(1, gettype($var1)) : array(2, gettype($var2));
            throw new \InvalidArgumentException("Both variables must be scalar - integer, float, string or boolean ({$type} given at parameter {$var}).");
        }
        // Strict comparison between two vars
        return $var1 === $var2;
    }
}