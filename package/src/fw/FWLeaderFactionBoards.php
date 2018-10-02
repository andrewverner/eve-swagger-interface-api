<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 16:56
 */

namespace DenisKhodakovskiyESI\src\fw;

use DenisKhodakovskiyESI\src\BaseObject;

class FWLeaderFactionBoards extends BaseObject
{
    /**
     * @var FWLeaderFactionBoard
     */
    public $kills;

    /**
     * @var FWLeaderFactionBoard
     */
    public $victoryPoints;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->kills = new FWLeaderFactionBoard($this->kills);
        $this->victoryPoints = new FWLeaderFactionBoard($this->victoryPoints);
    }
}
