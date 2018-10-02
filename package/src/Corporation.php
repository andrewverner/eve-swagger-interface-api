<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 14:49
 */

namespace DenisKhodakovskiyESI\src;

use DenisKhodakovskiyESI\package\src\assets\CorporationAsset;
use DenisKhodakovskiyESI\src\assets\AssetItemLocation;
use DenisKhodakovskiyESI\src\assets\AssetItemName;
use DenisKhodakovskiyESI\src\corporation\CorporationAllianceHistoryRecord;
use DenisKhodakovskiyESI\src\corporation\CorporationIcons;
use DenisKhodakovskiyESI\src\corporation\CorporationInfo;
use DenisKhodakovskiyESI\src\loyalty\LPStoreItem;

class Corporation
{
    /**
     * @var int
     */
    private $corporationId;

    /**
     * @var string
     */
    private $token;

    /**
     * @var CorporationInfo
     */
    private $info;

    /**
     * @var CorporationAllianceHistoryRecord[]
     */
    private $allianceHistory;

    /**
     * @var CorporationIcons
     */
    private $icons;

    /**
     * List of LP store items (for NPC corporations only)
     * @var LPStoreItem[]
     */
    private $lpStore;

    public function __construct($corporationId, $token = null)
    {
        $this->corporationId = $corporationId;
        if ($token) {
            $this->token = $token;
        }
    }

    /**
     * Returns an information about corporation
     * @return CorporationInfo
     * @throws \Exception
     */
    public function info()
    {
        if (!$this->info) {
            $this->isIdProvided();

            $data = (new Request("/corporations/{$this->corporationId}/"))
                ->execute();
            $this->info = new CorporationInfo($data);
        }

        return $this->info;
    }

    /**
     * Returns alliance history of the corporation
     * @return CorporationAllianceHistoryRecord[]
     * @throws \Exception
     */
    public function allianceHistory()
    {
        if ($this->allianceHistory) {
            $this->isIdProvided();

            $data = (new Request("/corporations/{$this->corporationId}/alliancehistory/"))
                ->execute();
            foreach ($data as &$record) {
                $record = new CorporationAllianceHistoryRecord($record);
            }

            $this->allianceHistory = $data;
        }

        return $this->allianceHistory;
    }

    /**
     * Returns corporations icons
     * @return CorporationIcons
     * @throws \Exception
     */
    public function icons()
    {
        if (!$this->icons) {
            $this->isIdProvided();

            $data = (new Request("/corporations/{$this->corporationId}/icons/"))
                ->execute();
            $this->icons = new CorporationIcons($data);
        }

        return $this->icons;
    }

    /**
     * Return a list of offers from a specific corporation’s loyalty store (for NPC corporations only)
     * @return LPStoreItem[]
     * @throws \Exception
     */
    public function lpStore()
    {
        if (!$this->lpStore) {
            $this->isIdProvided();

            $data = (new Request("/loyalty/stores/{$this->corporationId}/offers/"))
                ->execute();
            foreach ($data as &$item) {
                $item = new LPStoreItem($item);
            }

            $this->lpStore = $data;
        }

        return $this->lpStore;
    }

    /**
     * Return a list of the corporation assets
     * @param int $page
     * @return CorporationAsset[]
     * @throws \Exception
     */
    public function assets($page = 1)
    {
        $this->isTokenProvided();

        $assets = (new Request("/corporations/{$this->corporationId}/assets/"))
            ->setData([
                'token' => $this->token,
                'page' => $page,
            ])
            ->execute();

        foreach ($assets as &$asset) {
            $asset = new CorporationAsset($asset);
        }

        return $assets;
    }

    /**
     * Return locations for a set of item ids, which you can get from corporation assets endpoint. Coordinates for items in hangars or stations are set to (0,0,0)
     * @param array $itemsIds
     * @return AssetItemLocation[]
     * @throws \Exception
     */
    public function assetsLocations(array $itemsIds)
    {
        $this->isTokenProvided();

        $locations = (new Request("/corporations/{$this->corporationId}/assets/locations/?token={$this->token}"))
            ->setType(Request::TYPE_POST)
            ->setData(json_encode($itemsIds))
            ->execute();

        foreach ($locations as &$location) {
            $location = new AssetItemLocation($location);
        }

        return $locations;
    }

    /**
     * Return names for a set of item ids, which you can get from corporation assets endpoint. Only valid for items that can customize names, like containers or ships
     * @param array $itemsIds
     * @return AssetItemName[]
     * @throws \Exception
     */
    public function assetsNames(array $itemsIds)
    {
        $this->isTokenProvided();

        $names = (new Request("/corporations/{$this->corporationId}/assets/names/?token={$this->token}"))
            ->setType(Request::TYPE_POST)
            ->setData(json_encode($itemsIds))
            ->execute();

        foreach ($names as &$name) {
            $name = new AssetItemName($name);
        }

        return $names;
    }

    /**
     * Sets an access token
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @throws \Exception
     */
    private function isIdProvided()
    {
        if (!$this->corporationId) {
            throw new \Exception('Corporation Id must be provided', 400);
        }
    }

    /**
     * @throws \Exception
     */
    private function isTokenProvided()
    {
        if (!$this->token) {
            throw new \Exception('Access token must be provided', 400);
        }
    }
}
