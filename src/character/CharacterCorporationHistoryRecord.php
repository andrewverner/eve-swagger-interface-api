<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 13:17
 */

namespace DenisKhodakovskiyESI\src\character;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterCorporationHistoryRecord extends BaseObject
{
    /**
     * @var int
     */
    public $corporationId;

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
