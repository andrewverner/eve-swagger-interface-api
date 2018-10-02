<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.10.18
 * Time: 11:11
 */

namespace DenisKhodakovskiyESI\src\killmails;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterKillMailAttacker extends BaseObject
{
    /**
     * @var int
     */
    public $allianceId;

    /**
     * @var int
     */
    public $characterId;

    /**
     * @var int
     */
    public $corporationId;

    /**
     * @var int
     */
    public $damageDone;

    /**
     * @var int
     */
    public $factionId;

    /**
     * @var bool
     */
    public $finalBlow;

    /**
     * @var float
     */
    public $securityStatus;

    /**
     * @var int
     */
    public $shipTypeId;

    /**
     * @var int
     */
    public $weaponTypeId;
}
