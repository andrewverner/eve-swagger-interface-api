<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 14:49
 */

namespace DenisKhodakovskiyESI\src;

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
