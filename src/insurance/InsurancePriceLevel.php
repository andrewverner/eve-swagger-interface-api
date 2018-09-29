<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 28.09.18
 * Time: 20:29
 */

namespace DenisKhodakovskiyESI\src\insurance;

use DenisKhodakovskiyESI\src\BaseObject;

class InsurancePriceLevel extends BaseObject
{
    /**
     * @var float
     */
    public $cost;

    /**
     * @var string
     */
    public $name;

    /**
     * @var float
     */
    public $payout;
}
