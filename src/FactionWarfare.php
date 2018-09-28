<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 16:52
 */

namespace DenisKhodakovskiyESI\src;

use DenisKhodakovskiyESI\src\fw\FWLeaderFactionBoards;

class FactionWarfare
{
    private $leaderBoards;

    public function leaderBoards()
    {
        if (!$this->leaderBoards) {
            $data = (new Request('/fw/leaderboards/'))
                ->execute();
            $this->leaderBoards = new FWLeaderFactionBoards($data);
        }

        return $this->leaderBoards;
    }
}
