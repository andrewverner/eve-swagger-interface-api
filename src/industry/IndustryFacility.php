<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 17:35
 */

namespace DenisKhodakovskiyESI\src\industry;

use DenisKhodakovskiyESI\src\BaseObject;

class IndustryFacility extends BaseObject
{
    /**
     * @var int
     */
    public $facilityId;

    /**
     * @var int
     */
    public $ownerId;

    /**
     * @var int
     */
    public $regionId;

    /**
     * @var int
     */
    public $solarSystemId;

    /**
     * @var float
     */
    public $tax;

    /**
     * @var int
     */
    public $typeId;
}
