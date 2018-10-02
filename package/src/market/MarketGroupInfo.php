<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 28.09.18
 * Time: 21:31
 */

namespace DenisKhodakovskiyESI\src\market;

use DenisKhodakovskiyESI\src\BaseObject;

class MarketGroupInfo extends BaseObject
{
    /**
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $marketGroupId;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $parentGroupId;

    /**
     * @var int[]
     */
    public $types;
}
