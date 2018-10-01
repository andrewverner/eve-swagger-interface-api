<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 01.10.18
 * Time: 11:28
 */

namespace DenisKhodakovskiyESI\src\character;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterAgentsResearch extends BaseObject
{
    /**
     * @var int
     */
    public $agentId;

    /**
     * @var float
     */
    public $pointsPerDay;

    /**
     * @var float
     */
    public $remainderPoints;

    /**
     * @var int
     */
    public $skillTypeId;

    /**
     * @var \DateTime
     */
    public $startedAt;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->startedAt = new \DateTime($this->startedAt);
    }
}
