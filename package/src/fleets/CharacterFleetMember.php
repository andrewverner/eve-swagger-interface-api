<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 01.10.2018
 * Time: 22:21
 */

namespace DenisKhodakovskiyESI\src\fleets;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterFleetMember extends BaseObject
{
    /**
     * @var int
     */
    public $characterId;

    /**
     * @var \DateTime
     */
    public $joinTime;

    /**
     * @var string
     */
    public $role;

    /**
     * @var string
     */
    public $roleName;

    /**
     * @var int
     */
    public $shipTypeId;

    /**
     * @var int
     */
    public $solarSystemId;

    /**
     * @var int
     */
    public $squadId;

    /**
     * @var int
     */
    public $stationId;

    /**
     * @var bool
     */
    public $takesFleetWarp;

    /**
     * @var int
     */
    public $wingId;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->joinTime = new \DateTime($this->joinTime);
    }
}
