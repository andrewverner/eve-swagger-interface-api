<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.10.18
 * Time: 12:19
 */

namespace DenisKhodakovskiyESI\src\loyalty;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterLP extends BaseObject
{
    /**
     * @var int
     */
    public $corporationId;

    /**
     * @var int
     */
    public $loyaltyPoints;
}
