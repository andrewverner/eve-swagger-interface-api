<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.10.18
 * Time: 12:22
 */

namespace DenisKhodakovskiyESI\src\mail;

use DenisKhodakovskiyESI\src\BaseObject;
use DenisKhodakovskiyESI\src\Request;

class CharacterMail extends BaseObject
{
    /**
     * @var int
     */
    public $from;

    /**
     * @var int
     */
    public $isRead;

    /**
     * @var int[]
     */
    public $labels;

    /**
     * @var int
     */
    public $mailId;

    /**
     * @var CharacterMailRecipient[]
     */
    public $recipients;

    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $body;

    /**
     * @var bool
     */
    public $read;

    /**
     * @var \DateTime
     */
    public $timestamp;

    private $characterId;
    private $token;

    public function __construct($data, $characterId, $token)
    {
        parent::__construct($data);
        $this->timestamp = new \DateTime($this->timestamp);
        foreach ($this->recipients as &$recipient) {
            $recipient = new CharacterMailRecipient($recipient);
        }

        $this->characterId = $characterId;
        $this->token = $token;

        $mailData = (new Request("/characters/{$this->characterId}/mail/{$this->mailId}/"))
            ->setData(['token' => $token])
            ->execute();
        parent::__construct($mailData);

        $this->timestamp = new \DateTime($this->timestamp);
        $this->body = strip_tags($this->body);
    }
}
