<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 07/11/16
 * Time: 13:41
 */

namespace Toolbox\EntityInterface;

interface Entity
{
    /**
     * Returns the main identifier for each instance by calling get{Identifier}()
     * Useful to typehint entities and retrieve their identifier whether it's and in attribute or anything fancier.
     * Example:
     * public function returnIdentifier()
     * {
     *      return $this->getId();
     * }
     *
     * @return string|integer
     */
    public function returnIdentifier();
}