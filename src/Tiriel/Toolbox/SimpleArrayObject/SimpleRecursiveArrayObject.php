<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 15/01/17
 * Time: 10:31
 */

namespace Toolbox\SimpleArrayObject;


class SimpleRecursiveArrayObject
{
    private $_array = array();

    public function __construct(array $args = array())
    {
        foreach ($args as $key => $value) {
            $this->_array[$key] = new SimpleArrayObject($value);
        }
    }

    public function recursiveCall($function, $args = null)
    {
        $return  = array();
        foreach ($this->_array as $key => $array) {
            $result = $array->$function($args);
            $return = is_array($result) ? array_merge(/* Todo */) : $return[$key] = $result;
        }

        return count($return) <= 1 ? $return[0] : $return ;
    }
}