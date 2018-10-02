<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 29.09.18
 * Time: 12:14
 */

namespace DenisKhodakovskiyESI\src\market;

use DenisKhodakovskiyESI\src\BaseObject;

class MarketRegionOrder extends BaseObject
{
    const RANGE_REGION       = 'region';
    const RANGE_STATION      = 'station';
    const RANGE_SOLAR_SYSTEM = 'solarsystem';
    const RANGE_1  = 1;
    const RANGE_2  = 2;
    const RANGE_3  = 3;
    const RANGE_4  = 4;
    const RANGE_5  = 5;
    const RANGE_10 = 10;
    const RANGE_20 = 20;
    const RANGE_30 = 30;
    const RANGE_40 = 40;

    const ORDER_TYPE_SELL = 'sell';
    const ORDER_TYPE_BUY  = 'buy';
    const ORDER_TYPE_ALL  = 'all';

    /**
     * @var int
     */
    public $duration;

    /**
     * @var bool
     */
    public $isBuyOrder;

    /**
     * @var \DateTime
     */
    public $issued;

    /**
     * @var int
     */
    public $locationId;

    /**
     * @var int
     */
    public $minVolume;

    /**
     * @var int
     */
    public $orderId;

    /**
     * @var float
     */
    public $price;

    /**
     * @var string
     */
    public $range;

    /**
     * @var int
     */
    public $systemId;

    /**
     * @var int
     */
    public $typeId;

    /**
     * @var int
     */
    public $volumeRemain;

    /**
     * @var int
     */
    public $volumeTotal;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->issued = new \DateTime($this->issued);
    }
}
