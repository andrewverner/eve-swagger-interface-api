<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 29.09.18
 * Time: 22:53
 */

namespace DenisKhodakovskiyESI\src\character;

use DenisKhodakovskiyESI\src\BaseObject;

class AssetItemLocation extends BaseObject
{
    /**
     * @var int
     */
    public $itemId;

    /**
     * array of x, y and z coordinates
     * @var array
     */
    public $position;
}
