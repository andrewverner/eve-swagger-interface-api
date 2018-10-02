<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 11:31
 */

namespace DenisKhodakovskiyESI\src\alliance;

use DenisKhodakovskiyESI\src\BaseObject;

class PublicAllianceInfo extends BaseObject
{
    public $creatorCorporationId;
    public $creatorId;
    public $dateFounded;
    public $executorCorporationId;
    public $name;
    public $ticker;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->dateFounded = new \DateTime($this->dateFounded);
    }
}
