<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.10.18
 * Time: 11:03
 */

namespace DenisKhodakovskiyESI\src\killmails;

use DenisKhodakovskiyESI\src\BaseObject;
use DenisKhodakovskiyESI\src\Request;

class CharacterKillMail extends BaseObject
{
    /**
     * @var string
     */
    public $killmailHash;

    /**
     * @var int
     */
    public $killmailId;

    /**
     * @var CharacterKillMailAttacker[]
     */
    public $attackers;

    /**
     * @var \DateTime
     */
    public $killmailTime;

    /**
     * @var int
     */
    public $moonId;

    /**
     * @var int
     */
    public $solarSystemId;

    /**
     * @var CharacterKillMailVictim
     */
    public $victim;

    /**
     * @var int
     */
    public $warId;

    public function __construct($data, $token)
    {
        parent::__construct($data);

        $infoData = (new Request("/killmails/{$this->killmailId}/{$this->killmailHash}/"))
            ->setData(['token' => $token])
            ->execute();

        parent::__construct($infoData);

        $this->killmailTime = new \DateTime($this->killmailTime);
        foreach ($this->attackers as &$attacker) {
            $attacker = new CharacterKillMailAttacker($attacker);
        }
        if ($this->victim) {
            $this->victim = new CharacterKillMailVictim($this->victim);
        }
    }
}
