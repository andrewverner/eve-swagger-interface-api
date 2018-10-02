<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.10.18
 * Time: 10:17
 */

namespace DenisKhodakovskiyESI\src\fleets;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterFleetWings extends BaseObject
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var CharacterFleetSquad[]
     */
    public $squads;

    public function __construct($data)
    {
        parent::__construct($data);
        foreach ($this->squads as &$squad) {
            $squad = new CharacterFleetSquad($squad);
        }
    }
}
