<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 01.10.18
 * Time: 12:08
 */

namespace DenisKhodakovskiyESI\src\character;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterContactNotification extends BaseObject
{
    /**
     * @var string
     */
    public $message;

    /**
     * @var int
     */
    public $notificationId;

    /**
     * @var \DateTime
     */
    public $sendDate;

    /**
     * @var int
     */
    public $senderCharacterId;

    /**
     * @var float
     */
    public $standingLevel;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->sendDate = new \DateTime($this->sendDate);
    }
}
