<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.10.18
 * Time: 11:31
 */

namespace DenisKhodakovskiyESI\src\location;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterOnline extends BaseObject
{
    /**
     * @var \DateTime
     */
    public $lastLogin;

    /**
     * @var \DateTime
     */
    public $lastLogout;

    /**
     * @var int
     */
    public $logins;

    /**
     * @var bool
     */
    public $online;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->lastLogin = new \DateTime($this->lastLogin);
        $this->lastLogout = new \DateTime($this->lastLogout);
    }
}
