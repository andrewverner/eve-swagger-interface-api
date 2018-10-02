<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 28.09.18
 * Time: 20:44
 */

namespace DenisKhodakovskiyESI\src\loyalty;

use DenisKhodakovskiyESI\src\BaseObject;

class LPStoreItem extends BaseObject
{
    /**
     * Analysis kredit cost
     * @var int
     */
    public $akCost;

    /**
     * @var int
     */
    public $iskCost;

    /**
     * @var int
     */
    public $lpCost;

    /**
     * @var int
     */
    public $offerId;

    /**
     * @var int
     */
    public $quantity;

    /**
     * @var LPStoreRequiredItem[]
     */
    public $requiredItems;

    /**
     * @var int
     */
    public $typeId;

    public function __construct($data)
    {
        parent::__construct($data);
        foreach ($this->requiredItems as &$requiredItem) {
            $requiredItem = new LPStoreRequiredItem($requiredItem);
        }
    }
}
