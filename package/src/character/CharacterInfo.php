<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 13:07
 */

namespace DenisKhodakovskiyESI\src\character;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterInfo extends BaseObject
{
    /**
     * @var int
     */
    public $allianceId;

    /**
     * @var int
     */
    public $ancestryId;

    /**
     * @var \DateTime
     */
    public $birthday;

    /**
     * @var int
     */
    public $bloodlineId;

    /**
     * @var int
     */
    public $corporationId;

    /**
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $factionId;

    /**
     * @var string
     */
    public $gender;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $raceId;

    /**
     * @var float
     */
    public $securityStatus;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->birthday = new \DateTime($this->birthday);
    }
}
