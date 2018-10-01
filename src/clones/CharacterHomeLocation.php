<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 01.10.18
 * Time: 12:37
 */

namespace DenisKhodakovskiyESI\src\clones;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterHomeLocation extends BaseObject
{
    const LOCATION_TYPE_STATION = 'station';
    const LOCATION_TYPE_STRUCTURE = 'structure';

    /**
     * @var int
     */
    public $locationId;

    /**
     * @var string
     */
    public $locationType;
}
