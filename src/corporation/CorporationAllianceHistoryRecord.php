<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 16:33
 */

namespace DenisKhodakovskiyESI\src\corporation;

use DenisKhodakovskiyESI\src\BaseObject;

class CorporationAllianceHistoryRecord extends BaseObject
{
    /**
     * @var int
     */
    public $allianceId;

    /**
     * @var bool
     */
    public $isDeleted;

    /**
     * @var int
     */
    public $recordId;

    /**
     * @var \DateTime
     */
    public $startDate;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->startDate = new \DateTime($this->startDate);
    }
}
