<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 30.09.2018
 * Time: 10:57
 */

namespace DenisKhodakovskiyESI\src\calendar;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterCalendarEventInfo extends BaseObject
{
    const OWNER_TYPE_CORPORATION = 'corporation';
    const OWNER_TYPE_EVE_SERVER  = 'eve_server';
    const OWNER_TYPE_CHARACTER   = 'character';
    const OWNER_TYPE_ALLIANCE    = 'alliance ';
    const OWNER_TYPE_FACTION     = 'faction';

    /**
     * @var \DateTime
     */
    public $date;

    /**
     * @var int
     */
    public $duration;

    /**
     * @var int
     */
    public $eventId;

    /**
     * @var int
     */
    public $importance;

    /**
     * @var int
     */
    public $ownerId;

    /**
     * @var string
     */
    public $ownerName;

    /**
     * @var string
     */
    public $ownerType;

    /**
     * @var string
     */
    public $response;

    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $title;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->date = new \DateTime($this->date);
    }
}
