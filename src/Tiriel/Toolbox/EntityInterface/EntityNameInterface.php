<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 07/11/16
 * Time: 13:41
 */

namespace Toolbox\EntityInterface;

interface EntityNameInterface extends EntityInterface
{
    /**
     * Returns the entity Class Name
     * @return string
     */
    public function returnEntityType();
}