<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.10.18
 * Time: 11:27
 */

namespace DenisKhodakovskiyESI\src\location;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterLocation extends BaseObject
{
    /**
     * @var int
     */
    public $solarSystemId;

    /**
     * @var int
     */
    public $stationId;

    /**
     * @var int
     */
    public $structureId;
}
