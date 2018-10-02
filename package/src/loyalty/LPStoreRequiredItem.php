<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 28.09.18
 * Time: 20:46
 */

namespace DenisKhodakovskiyESI\src\loyalty;

use DenisKhodakovskiyESI\src\BaseObject;

class LPStoreRequiredItem extends BaseObject
{
    /**
     * @var int
     */
    public $quantity;

    /**
     * @var int
     */
    public $typeId;
}
