<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 01.10.18
 * Time: 17:36
 */

namespace DenisKhodakovskiyESI\src\contracts;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterContractItem extends BaseObject
{
    /**
     * @var bool
     */
    public $isIncluded;

    /**
     * @var bool
     */
    public $isSingleton;

    /**
     * @var int
     */
    public $quantity;

    /**
     * @var int
     */
    public $rawQuantity;

    /**
     * @var int
     */
    public $recordId;

    /**
     * @var int
     */
    public $itemId;
}
