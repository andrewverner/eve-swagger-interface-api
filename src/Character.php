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
use DenisKhodakovskiyESI\src\character\AssetItemName;
use DenisKhodakovskiyESI\src\character\CharacterBookmark;
use DenisKhodakovskiyESI\src\character\CharacterBookmarkFolder;
use DenisKhodakovskiyESI\src\character\CharacterCalendarEvent;
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
     * Return locations for a set of item ids, which you can get from character assets endpoint. Coordinates for items in hangars or stations are set to (0,0,0)
     * @param array $itemIds
     * @return AssetItemLocation[]
     * @throws \Exception
     */
    public function assetsLocations(array $itemIds)
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $data = (new Request("/characters/{$this->characterId}/assets/locations/?token={$this->token}"))
            ->setType(Request::TYPE_POST)
            ->setData(json_encode($itemIds))
            ->execute();

        foreach ($data as &$row) {
            $row = new AssetItemLocation($row);
        }

        return $data;
    }

    /**
     * Return names for a set of item ids, which you can get from character assets endpoint. Typically used for items that can customize names, like containers or ships
     * @param array $itemIds
     * @return AssetItemName[]
     * @throws \Exception
     */
    public function assetsNames(array $itemIds)
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $data = (new Request("/characters/{$this->characterId}/assets/names/?token={$this->token}"))
            ->setType(Request::TYPE_POST)
            ->setData(json_encode($itemIds))
            ->execute();

        foreach ($data as &$row) {
            $row = new AssetItemName($row);
        }

        return $data;
    }

    /**
     * A list of your character’s personal bookmarks
     * @param int $page
     * @return CharacterBookmark[]
     * @throws \Exception
     */
    public function bookmarks($page = 1)
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $data = (new Request("/characters/{$this->characterId}/bookmarks/"))
            ->setData([
                'page' => $page,
                'token' => $this->token,
            ])
            ->execute();

        foreach ($data as &$bookmark) {
            $bookmark = new CharacterBookmark($bookmark);
        }

        return $data;
    }

    /**
     * A list of your character’s personal bookmark folders
     * @param int $page
     * @return CharacterBookmarkFolder[]
     * @throws \Exception
     */
    public function bookmarksFolders($page = 1)
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $data = (new Request("/characters/{$this->characterId}/bookmarks/folders/"))
            ->setData([
                'page' => $page,
                'token' => $this->token,
            ])
            ->execute();

        foreach ($data as &$folder) {
            $folder = new CharacterBookmarkFolder($folder);
        }

        return $data;
    }

    public function calendarEvents($fromEvent = null)
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $params = ['token' => $this->token];
        if ($fromEvent) {
            $params['from_event'] = $fromEvent;
        }
        $data = (new Request("/characters/{$this->characterId}/bookmarks/folders/"))
            ->setData($params)
            ->execute();

        foreach ($data as &$event) {
            $event = new CharacterCalendarEvent($event);
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
