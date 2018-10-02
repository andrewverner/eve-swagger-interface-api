<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.10.18
 * Time: 12:16
 */

namespace DenisKhodakovskiyESI\src\location;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterShip extends BaseObject
{
    /**
     * @var int
     */
    public $shipItemId;

    /**
     * @var string
     */
    public $shipName;

    /**
     * @var int
     */
    public $shipTypeId;
}
