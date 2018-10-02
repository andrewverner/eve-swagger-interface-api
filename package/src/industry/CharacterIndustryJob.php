<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.10.18
 * Time: 10:49
 */

namespace DenisKhodakovskiyESI\src\industry;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterIndustryJob extends BaseObject
{
    /**
     * @var int
     */
    public $activityId;

    /**
     * @var int
     */
    public $blueprintId;

    /**
     * @var int
     */
    public $blueprintLocationId;

    /**
     * @var int
     */
    public $blueprintTypeId;

    /**
     * @var float
     */
    public $cost;

    /**
     * @var int
     */
    public $duration;

    /**
     * @var \DateTime
     */
    public $endDate;

    /**
     * @var int
     */
    public $facilityId;

    /**
     * @var int
     */
    public $installerId;

    /**
     * @var int
     */
    public $jobId;

    /**
     * @var int
     */
    public $licensedRuns;

    /**
     * @var int
     */
    public $outputLocationId;

    /**
     * @var int
     */
    public $runs;

    /**
     * @var \DateTime
     */
    public $startDate;

    /**
     * @var int
     */
    public $stationId;

    /**
     * @var string
     */
    public $status;

    const STATUS_ACTIVE = 'active';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_PAUSED = 'paused';
    const STATUS_READY = 'ready';
    const STATUS_REVERTED = 'reverted';

    public function __construct($data)
    {
        parent::__construct($data);
        $this->startDate = new \DateTime($this->startDate);
        $this->endDate = new \DateTime($this->endDate);
    }
}
