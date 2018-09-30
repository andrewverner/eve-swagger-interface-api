<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 30.09.18
 * Time: 12:38
 */

namespace DenisKhodakovskiyESI\src\character;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterCalendarEvent extends BaseObject
{
    const EVENT_RESPONSE_NOT_RESPONDED = 'not_responded';
    const EVENT_RESPONSE_TENTATIVE     = 'tentative';
    const EVENT_RESPONSE_DECLINED      = 'declined';
    const EVENT_RESPONSE_ACCEPTED      = 'accepted';

    /**
     * @var \DateTime
     */
    public $eventDate;

    /**
     * @var int
     */
    public $eventId;

    /**
     * @var string
     */
    public $eventResponse;

    /**
     * @var int
     */
    public $importance;

    /**
     * @var string
     */
    public $title;
}
