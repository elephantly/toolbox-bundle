<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 15/01/17
 * Time: 10:31
 */

namespace Toolbox\SimpleArrayObject;

/**
 * Class SimpleRecursiveArrayObject
 * @package Toolbox\SimpleArrayObject
 */
class SimpleRecursiveArrayObject extends SimpleArrayObject implements \RecursiveIterator
{
    /**
     * @param $function
     * @param null $args
     * @return array|mixed
     */
    public function recursiveCall($function, $args = null)
    {
        $return  = array();
        foreach ($this->_array as $key => $array) {
            $static       = new static($array);
            $result[$key] = $static->$function($args);
        }

        return count($return) <= 1 ? $return[0] : $return ;
    }

    /**
     * @return bool
     */
    public function hasChildren()
    {
        return is_array($this->current()) || is_object($this->current());
    }

    /**
     * @return static
     */
    public function getChildren()
    {
        return new static($this->current());
    }
}