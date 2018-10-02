<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 14:00
 */

namespace DenisKhodakovskiyESI\src\contracts;

use DenisKhodakovskiyESI\src\BaseObject;

class PublicContractBid extends BaseObject
{
    /**
     * The amount bid, in ISK
     * @var float
     */
    public $amount;

    /**
     * @var int
     */
    public $bidId;

    /**
     * Datetime when the bid was placed
     * @var \DateTime
     */
    public $dateBid;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->dateBid = new \DateTime($this->dateBid);
    }
}
