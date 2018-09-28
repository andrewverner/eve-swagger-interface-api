<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 14:36
 */

namespace DenisKhodakovskiyESI\src\contracts;

use DenisKhodakovskiyESI\src\BaseObject;

class PublicContractItem extends BaseObject
{
    /**
     * @var bool
     */
    public $isBlueprintCopy;

    /**
     * true if the contract issuer has submitted this item with the contract, false if the isser is asking for this item in the contract
     * @var bool
     */
    public $isIncluded;

    /**
     * @var int
     */
    public $itemId;

    /**
     * Material Efficiency Level of the blueprint
     * @var int
     */
    public $materialEfficiency;

    /**
     * Number of items in the stack
     * @var int
     */
    public $quantity;

    /**
     * Unique ID for the item, used by the contract system
     * @var int
     */
    public $recordId;

    /**
     * Number of runs remaining if the blueprint is a copy, -1 if it is an original
     * @var int
     */
    public $runs;

    /**
     * Time Efficiency Level of the blueprint
     * @var int
     */
    public $timeEfficiency;

    /**
     * Type ID for item
     * @var int
     */
    public $typeId;
}
