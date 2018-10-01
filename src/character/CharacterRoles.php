<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 01.10.18
 * Time: 12:12
 */

namespace DenisKhodakovskiyESI\src\character;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterRoles extends BaseObject
{
    /**
     * @var CharacterRole[]
     */
    public $roles;

    /**
     * @var CharacterRole[]
     */
    public $rolesAtBase;

    /**
     * @var CharacterRole[]
     */
    public $rolesAtHq;

    /**
     * @var CharacterRole[]
     */
    public $rolesAtOther;

    public function __construct($data)
    {
        parent::__construct($data);
        if ($this->roles) {
            foreach ($this->roles as &$role) {
                $role = new CharacterRole($role);
            }
        }
        if ($this->rolesAtBase) {
            foreach ($this->rolesAtBase as &$roleAtBase) {
                $roleAtBase = new CharacterRole($roleAtBase);
            }
        }
        if ($this->rolesAtHq) {
            foreach ($this->rolesAtHq as &$roleAtHq) {
                $roleAtHq = new CharacterRole($roleAtHq);
            }
        }
        if ($this->rolesAtOther) {
            foreach ($this->rolesAtOther as &$roleAtOther) {
                $roleAtOther = new CharacterRole($roleAtOther);
            }
        }
    }
}
