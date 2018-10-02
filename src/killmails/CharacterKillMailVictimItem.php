<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.10.18
 * Time: 11:15
 */

namespace DenisKhodakovskiyESI\src\killmails;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterKillMailVictimItem extends BaseObject
{
    /**
     * @var int
     */
    public $flag;

    /**
     * @var int
     */
    public $itemTypeId;

    /**
     * @var int
     */
    public $quantityDestroyed;

    /**
     * @var int
     */
    public $quantityDropped;

    /**
     * @var int
     */
    public $singleton;

}
