<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 01.10.18
 * Time: 11:40
 */

namespace DenisKhodakovskiyESI\src\character;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterJumpFatigue extends BaseObject
{
    /**
     * @var \DateTime
     */
    public $jumpFatigueExpireDate;

    /**
     * @var \DateTime
     */
    public $lastJumpDate;

    /**
     * @var \DateTime
     */
    public $lastUpdateDate;

    public function __construct($data)
    {
        parent::__construct($data);
        if ($this->jumpFatigueExpireDate) {
            $this->jumpFatigueExpireDate = new \DateTime($this->jumpFatigueExpireDate);
        }
        if ($this->lastJumpDate) {
            $this->lastJumpDate = new \DateTime($this->lastJumpDate);
        }
        if ($this->lastUpdateDate) {
            $this->lastUpdateDate = new \DateTime($this->lastUpdateDate);
        }
    }
}
