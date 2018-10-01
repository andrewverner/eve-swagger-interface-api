<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 01.10.18
 * Time: 12:25
 */

namespace DenisKhodakovskiyESI\src\clones;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterClones extends BaseObject
{
    /**
     * @var CharacterHomeLocation
     */
    public $homeLocation;

    /**
     * @var CharacterJumpClone[]
     */
    public $jumpClones;

    /**
     * @var \DateTime
     */
    public $lastCloneJumpDate;

    /**
     * @var \DateTime
     */
    public $lastStationChangeDate;

    public function __construct($data)
    {
        parent::__construct($data);
        if ($this->jumpClones) {
            foreach ($this->jumpClones as &$jumpClone) {
                $jumpClone = new CharacterJumpClone($jumpClone);
            }
        }
        if ($this->lastCloneJumpDate) {
            $this->lastCloneJumpDate = new \DateTime($this->lastCloneJumpDate);
        }
    }
}
