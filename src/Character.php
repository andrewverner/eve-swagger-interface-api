<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 12:57
 */

namespace DenisKhodakovskiyESI\src;

use DenisKhodakovskiyESI\src\character\AssetItem;
use DenisKhodakovskiyESI\src\character\AssetItemLocation;
use DenisKhodakovskiyESI\src\character\CharacterCorporationHistoryRecord;
use DenisKhodakovskiyESI\src\character\CharacterInfo;
use DenisKhodakovskiyESI\src\character\CharacterPortrait;

class Character
{
    /**
     * Character id
     * @var int
     */
    private $characterId;

    /**
     * Character API access token
     * @var string
     */
    private $token;

    /**
     * Public character information
     * @var CharacterInfo
     */
    private $info;

    /**
     * Character corporation history array
     * @var CharacterCorporationHistoryRecord[]
     */
    private $corporationHistory;

    /**
     * Character portrait
     * @var CharacterPortrait
     */
    private $portrait;

    public function __construct($characterId, $token = null)
    {
        $this->characterId = $characterId;
        if ($token) {
            $this->token = $token;
        }
    }

    /**
     * Return public character info
     * @return CharacterInfo
     * @throws \Exception
     */
    public function info()
    {
        if (!$this->info) {
            $this->isIdProvided();

            $data = (new Request("/characters/{$this->characterId}/"))
                ->execute();
            $this->info = new CharacterInfo($data);
        }

        return $this->info;
    }

    /**
     * Return character corporation history
     * @return CharacterCorporationHistoryRecord[]
     * @throws \Exception
     */
    public function corporationHistory()
    {
        if (!$this->corporationHistory) {
            $this->isIdProvided();

            $data = (new Request("/characters/{$this->characterId}/corporationhistory/"))
                ->execute();
            foreach ($data as $record) {
                $this->corporationHistory[] = new CharacterCorporationHistoryRecord($record);
            }
        }

        return $this->corporationHistory;
    }

    /**
     * Returns character portrait
     * @return CharacterCorporationHistoryRecord|CharacterPortrait
     * @throws \Exception
     */
    public function portrait()
    {
        if (!$this->portrait) {
            $this->isIdProvided();

            $data = (new Request("/characters/{$this->characterId}/portrait/"))
                ->execute();
            $this->portrait = new CharacterPortrait($data);
        }

        return $this->portrait;
    }

    /**
     * Character assets list
     * @param int $page
     * @return AssetItem[]
     * @throws \Exception
     */
    public function assets($page = 1)
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $assets = (new Request("/characters/{$this->characterId}/assets/"))
            ->setData([
                'page' => $page,
                'token' => $this->token,
            ])
            ->execute();

        foreach ($assets as &$asset) {
            $asset = new AssetItem($asset);
        }

        return $assets;
    }

    /**
     * @param array $itemIds
     * @return AssetItemLocation[]
     * @throws \Exception
     */
    public function assetsLocations(array $itemIds)
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $data = (new Request("/characters/{$this->characterId}/assets/locations/"))
            ->setType(Request::TYPE_POST)
            ->setData(json_encode($itemIds))
            ->setData(['token' => $this->token])
            ->execute();

        foreach ($data as &$row) {
            $row = new AssetItemLocation($row);
        }

        return $data;
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
        if (!$this->characterId) {
            throw new \Exception('Character Id must be provided', 400);
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
