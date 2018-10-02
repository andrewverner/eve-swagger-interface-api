<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 28.09.18
 * Time: 20:28
 */

namespace DenisKhodakovskiyESI\src\insurance;

use DenisKhodakovskiyESI\src\BaseObject;

class InsurancePrice extends BaseObject
{
    /**
     * @var InsurancePriceLevel[]
     */
    public $levels;

    /**
     * @var int
     */
    public $typeId;

    public function __construct($data)
    {
        parent::__construct($data);
        foreach ($this->levels as &$level) {
            $level = new InsurancePriceLevel($level);
        }
    }
}
