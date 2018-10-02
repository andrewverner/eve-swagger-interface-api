<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.10.18
 * Time: 10:59
 */

namespace DenisKhodakovskiyESI\src\industry;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterMiningRecord extends BaseObject
{
    /**
     * @var \DateTime
     */
    public $date;

    /**
     * @var int
     */
    public $quantity;

    /**
     * @var int
     */
    public $solarSystemId;

    /**
     * @var int
     */
    public $typeId;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->date = new \DateTime($this->date);
    }
}
