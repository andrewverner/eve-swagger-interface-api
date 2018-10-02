<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 17:26
 */

namespace DenisKhodakovskiyESI\src\incursions;

use DenisKhodakovskiyESI\src\BaseObject;

class Incursion extends BaseObject
{
    const STATE_WITHDRAWING = 'withdrawing';
    const STATE_ESTABLISHED = 'established';
    const STATE_MOBILIZING  = 'mobilizing';

    /**
     * @var int
     */
    public $constellationId;

    /**
     * @var int
     */
    public $factionId;

    /**
     * @var bool
     */
    public $hasBoss;

    /**
     * @var int[]
     */
    public $infestedSolarSystems;

    /**
     * @var float
     */
    public $influence;

    /**
     * @var int
     */
    public $stagingSolarSystemId;

    /**
     * @var string
     */
    public $state;

    /**
     * @var string
     */
    public $type;
}
