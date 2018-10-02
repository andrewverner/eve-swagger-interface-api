<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 28.09.18
 * Time: 21:08
 */

namespace DenisKhodakovskiyESI\src\market;

use DenisKhodakovskiyESI\src\BaseObject;

class MarketPrise extends BaseObject
{
    /**
     * @var float
     */
    public $adjustedPrice;

    /**
     * @var float
     */
    public $averagePrice;

    /**
     * @var int
     */
    public $typeId;
}
