<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 01.10.18
 * Time: 17:39
 */

namespace DenisKhodakovskiyESI\src\fleets;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterFleet extends BaseObject
{
    const ROLE_FLEET_COMMANDER = 'fleet_commander';
    const ROLE_SQUAD_COMMANDER = 'squad_commander';
    const ROLE_WING_COMMANDER  = 'wing_commander';
    const ROLE_SQUAD_MEMBER    = 'squad_member';

    /**
     * @var int
     */
    public $fleetId;

    /**
     * @var string
     */
    public $role;

    /**
     * ID of the squad the member is in. If not applicable, will be set to -1
     * @var int
     */
    public $squadId;

    /**
     * ID of the wing the member is in. If not applicable, will be set to -1
     * @var int
     */
    public $wingId;
}
