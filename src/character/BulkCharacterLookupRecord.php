<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 13:35
 */

namespace DenisKhodakovskiyESI\src\character;

use DenisKhodakovskiyESI\src\BaseObject;

class BulkCharacterLookupRecord extends BaseObject
{
    /**
     * Character Id
     * @var int
     */
    public $characterId;

    /**
     * Corporation Id
     * @var int
     */
    public $corporationId;

    /**
     * Alliance Id
     * @var int
     */
    public $allianceId;

    /**
     * Faction Id
     * @var int
     */
    public $factionId;
}
