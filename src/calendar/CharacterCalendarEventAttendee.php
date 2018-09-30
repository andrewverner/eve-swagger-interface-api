<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 30.09.2018
 * Time: 10:25
 */

namespace DenisKhodakovskiyESI\src\calendar;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterCalendarEventAttendee extends BaseObject
{
    /**
     * @var int
     */
    public $characterId;

    /**
     * @var string
     */
    public $eventResponse;
}
