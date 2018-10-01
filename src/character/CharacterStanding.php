<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 01.10.18
 * Time: 12:19
 */

namespace DenisKhodakovskiyESI\src\character;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterStanding extends BaseObject
{
    const FROM_TYPE_NPC_CORP = 'npc_corp';
    const FROM_TYPE_FACTION  = 'faction';
    const FROM_TYPE_AGENT    = 'agent';

    /**
     * @var int
     */
    public $fromId;

    /**
     * @var string
     */
    public $fromType;

    /**
     * @var float
     */
    public $standing;
}
