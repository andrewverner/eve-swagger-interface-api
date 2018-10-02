<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 17:48
 */

namespace DenisKhodakovskiyESI\src\industry;

use DenisKhodakovskiyESI\src\BaseObject;

class IndustrySystem extends BaseObject
{
    /**
     * @var IndustryCostIndex[]
     */
    public $costIndices;

    /**
     * @var int
     */
    public $solarSystemId;

    public function __construct($data)
    {
        parent::__construct($data);
        foreach ($this->costIndices as &$index) {
            $index = new IndustryCostIndex($index);
        }
    }
}
