<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.10.18
 * Time: 11:13
 */

namespace DenisKhodakovskiyESI\src\killmails;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterKillMailVictim extends BaseObject
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
    public $damageTaken;

    /**
     * @var int
     */
    public $factionId;

    /**
     * @var CharacterKillMailVictimItem[]
     */
    public $items;

    /**
     * @var array
     */
    public $position;

    /**
     * @var int
     */
    public $shipTypeId;

    public function __construct($data)
    {
        parent::__construct($data);
        foreach ($this->items as &$item) {
            $item = new CharacterKillMailVictimItem($item);
        }
    }
}
