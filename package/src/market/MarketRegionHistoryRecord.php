<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 29.09.18
 * Time: 11:57
 */

namespace DenisKhodakovskiyESI\src\market;

use DenisKhodakovskiyESI\src\BaseObject;

class MarketRegionHistoryRecord extends BaseObject
{
    /**
     * @var float
     */
    public $average;

    /**
     * The date of this historical statistic entry
     * @var \DateTime
     */
    public $date;

    /**
     * @var float
     */
    public $highest;

    /**
     * @var float
     */
    public $lowest;

    /**
     * @var int
     */
    public $orderCount;

    /**
     * @var int
     */
    public $volume;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->date = new \DateTime($this->date);
    }
}
