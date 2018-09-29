<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 28.09.18
 * Time: 21:26
 */

namespace DenisKhodakovskiyESI\src\market;

use DenisKhodakovskiyESI\src\Request;

class MarketGroup
{
    /**
     * @var int
     */
    private $groupId;

    /**
     * @var MarketGroupInfo
     */
    private $info;

    public function __construct($groupId)
    {
        $this->groupId = $groupId;
    }

    /**
     * Get information on an item group
     * @return MarketGroupInfo
     * @throws \Exception
     */
    public function info()
    {
        if (!$this->info) {
            $data = (new Request("/markets/groups/{$this->groupId}/"))
                ->execute();
            $this->info = new MarketGroupInfo($data);
        }

        return $this->info;
    }
}
