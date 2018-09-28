<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 17:00
 */

namespace DenisKhodakovskiyESI\src\fw;

class FWLeaderFactionBoard
{
    /**
     * @var FwLeaderBoardFactionRecord[]
     */
    public $activeTotal;

    /**
     * @var FwLeaderBoardFactionRecord[]
     */
    public $lastWeek;

    /**
     * @var FwLeaderBoardFactionRecord[]
     */
    public $yesterday;

    public function __construct($data)
    {
        foreach ($data['active_total'] as $record) {
            $this->activeTotal[] = new FwLeaderBoardFactionRecord($record);
        }
        foreach ($data['last_week'] as $record) {
            $this->lastWeek[] = new FwLeaderBoardFactionRecord($record);
        }
        foreach ($data['yesterday'] as $record) {
            $this->yesterday[] = new FwLeaderBoardFactionRecord($record);
        }
    }
}
