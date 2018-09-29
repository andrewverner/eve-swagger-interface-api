<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 28.09.18
 * Time: 21:06
 */

namespace DenisKhodakovskiyESI\src;

use DenisKhodakovskiyESI\src\market\MarketGroup;
use DenisKhodakovskiyESI\src\market\MarketPrise;
use DenisKhodakovskiyESI\src\market\MarketRegionHistoryRecord;
use DenisKhodakovskiyESI\src\market\MarketRegionOrder;

class Market
{
    /**
     * @var MarketPrise[]
     */
    private $prizes;

    /**
     * @var MarketGroup[]
     */
    private $groups;

    /**
     * Return a list of prices
     * @return MarketPrise[]
     * @throws \Exception
     */
    public function prizes()
    {
        if (!$this->prizes) {
            $this->prizes = (new Request('/markets/prices/'))
                ->execute();
            foreach ($this->prizes as &$prise) {
                $prise = new MarketPrise($prise);
            }
        }

        return $this->prizes;
    }

    /**
     * Get a list of item groups
     * @return MarketGroup[]
     * @throws \Exception
     */
    public function groups()
    {
        if (!$this->groups) {
            $this->groups = (new Request('/markets/groups/'))
                ->execute();
            foreach ($this->groups as &$group) {
                $group = new MarketGroup($group);
            }
        }

        return $this->groups;
    }

    /**
     * Return a list of historical market statistics for the specified type in a region
     * @param $regionId
     * @param $typeId
     * @return MarketRegionHistoryRecord[]
     * @throws \Exception
     */
    public function regionHistory($regionId, $typeId)
    {
        $data = (new Request("/markets/{$regionId}/history/"))
            ->setData(['type_id' => $typeId])
            ->execute();
        foreach ($data as &$record) {
            $record = new MarketRegionHistoryRecord($record);
        }

        return $data;
    }

    /**
     * Return a list of orders in a region
     * @param $regionId
     * @param string $orderType
     * @param null $page
     * @param null $typeId
     * @return MarketRegionOrder[]
     * @throws \Exception
     */
    public function regionOrders($regionId, $orderType = MarketRegionOrder::ORDER_TYPE_ALL, $page = 1, $typeId = null)
    {
        $params = ['order_type' => $orderType];
        if ($page) {
            $params['page'] = $page;
        }
        if ($typeId) {
            $params['type_id'] = $typeId;
        }

        $data = (new Request("/markets/{$regionId}/orders/"))
            ->setData($params)
            ->execute();
        foreach ($data as &$order) {
            $order = new MarketRegionOrder($order);
        }

        return $data;
    }

    /**
     * Return a list of type IDs that have active orders in the region, for efficient market indexing.
     * @param $regionId
     * @param int $page
     * @return int[]
     * @throws \Exception
     */
    public function regionTypes($regionId, $page = 1)
    {
        return (new Request("/markets/{$regionId}/types/"))
            ->setData(['page' => $page])
            ->execute();
    }
}
