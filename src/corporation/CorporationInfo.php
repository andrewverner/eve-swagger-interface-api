<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 15:51
 */

namespace DenisKhodakovskiyESI\src\corporation;

use DenisKhodakovskiyESI\src\BaseObject;

class CorporationInfo extends BaseObject
{
    /**
     * @var int
     */
    public $allianceId;

    /**
     * @var int
     */
    public $ceoId;

    /**
     * @var int
     */
    public $creatorId;

    /**
     * @var \DateTime
     */
    public $dateFounded;

    /**
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $factionId;

    /**
     * @var int
     */
    public $homeStationId;

    /**
     * @var int
     */
    public $memberCount;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $shares;

    /**
     * @var float
     */
    public $taxRate;

    /**
     * @var string
     */
    public $ticker;

    /**
     * @var string
     */
    public $url;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->dateFounded = new \DateTime($this->dateFounded);
    }
}
