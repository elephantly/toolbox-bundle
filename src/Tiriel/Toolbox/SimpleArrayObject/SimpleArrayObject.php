<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 14/01/17
 * Time: 16:49
 */

namespace Toolbox\SimpleArrayObject;


/**
 * Class SimpleArrayObject
 * @package Toolbox\SimpleArrayObject
 */
/**
 * Class SimpleArrayObject
 * @package Toolbox\SimpleArrayObject
 */
class SimpleArrayObject
{
    /**
     * @var array
     */
    private $_array;

    /**
     * SimpleArrayObject constructor.
     * @param array $args
     */
    public function __construct(array $args = array())
    {
        $this->_array = $args;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->_array;
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return reset($this->_array);
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return current($this->_array);
    }

    /**
     * @return mixed
     */
    public function key()
    {
        return key($this->_array);
    }

    /**
     * @return mixed
     */
    public function next()
    {
        return next($this->_array);
    }

    /**
     * @return mixed
     */
    public function last()
    {
        return end($this->_array);
    }

    /**
     * @param $element
     * @return $this
     */
    public function unshiftElement($element)
    {
        array_unshift($this->_array, $element);

        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function add($key, $value)
    {
        $this->_array[$key] = $value;

        return $this;
    }

    /**
     * @param $element
     * @return $this
     */
    public function addElement($element)
    {
        $this->_array[] = $element;

        return $this;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function remove($key)
    {
        if (array_key_exists($key, $this->_array)) {
            $removed = $this->_array[$key];
            unset($this->_array[$key]);
            return $removed;
        }

        return null;
    }

    /**
     * @param $element
     * @return $this
     */
    public function removeElement($element)
    {
        if ($this->exists($element)) {
            $this->remove($this->indexOf($element));
        }
        return $this;
    }

    /**
     * @param $key
     * @return bool
     */
    public function keyExists($key)
    {
        return array_key_exists($key, $this->_array);
    }

    /**
     * @param $element
     * @return bool
     */
    public function exists($element)
    {
        return false !== array_search($element, $this->_array, true);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->_array);
    }

    /**
     * @param \Closure $closure
     * @return bool
     */
    public function walk(\Closure $closure)
    {
        return array_walk($this->_array, $closure);
    }

    /**
     * @param \Closure $closure
     * @return static
     */
    public function map(\Closure $closure)
    {
        return new static(array_map($closure, $this->_array));
    }

    /**
     * @param \Closure $closure
     * @return static
     */
    public function filter(\Closure $closure)
    {
        return new static(array_filter($this->_array, $closure));
    }

    /**
     * @param $element
     * @return mixed|null
     */
    public function indexOf($element)
    {
        if ($this->exists($element)) {
            return array_search($element, $this->_array, true);
        }
        return null;
    }

    /**
     * @return array
     */
    public function getKeys()
    {
        return array_keys($this->_array);
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return array_values($this->_array);
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->_array);
    }

    /**
     * @return $this
     */
    public function clear()
    {
        $this->_array = array();

        return $this;
    }

    /**
     * @param \Closure $closure
     * @return array
     */
    public function divide(\Closure $closure)
    {
        $col1 = $col2 = array();
        foreach ($this->_array as $key => $value) {
            if ($closure($key, $value)) {
                $col1[$key] = $value;
            } else {
                $col2[$key] = $value;
            }
        }

        return array(new static($col1), new static($col2));
    }

    /**
     * @param $offset
     * @param null $length
     * @return array
     */
    public function slice($offset, $length = null)
    {
        return array_slice($this->_array, $offset, $length, true);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return __CLASS__;
    }
}