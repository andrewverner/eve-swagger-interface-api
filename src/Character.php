<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 12:57
 */

namespace DenisKhodakovskiyESI\src;

use DenisKhodakovskiyESI\src\assets\AssetItem;
use DenisKhodakovskiyESI\src\assets\AssetItemLocation;
use DenisKhodakovskiyESI\src\assets\AssetItemName;
use DenisKhodakovskiyESI\src\bookmarks\CharacterBookmark;
use DenisKhodakovskiyESI\src\bookmarks\CharacterBookmarkFolder;
use DenisKhodakovskiyESI\src\calendar\CharacterCalendarEvent;
use DenisKhodakovskiyESI\src\calendar\CharacterCalendarEventAttendee;
use DenisKhodakovskiyESI\src\calendar\CharacterCalendarEventInfo;
use DenisKhodakovskiyESI\src\character\CharacterAgentsResearch;
use DenisKhodakovskiyESI\src\character\CharacterBlueprint;
use DenisKhodakovskiyESI\src\character\CharacterContactNotification;
use DenisKhodakovskiyESI\src\character\CharacterCorporationHistoryRecord;
use DenisKhodakovskiyESI\src\character\CharacterInfo;
use DenisKhodakovskiyESI\src\character\CharacterJumpFatigue;
use DenisKhodakovskiyESI\src\character\CharacterMedal;
use DenisKhodakovskiyESI\src\character\CharacterNotification;
use DenisKhodakovskiyESI\src\character\CharacterPortrait;
use DenisKhodakovskiyESI\src\character\CharacterRoles;
use DenisKhodakovskiyESI\src\character\CharacterStanding;
use DenisKhodakovskiyESI\src\character\CharacterTitle;
use DenisKhodakovskiyESI\src\clones\CharacterClones;
use DenisKhodakovskiyESI\src\contacts\CharacterContact;
use DenisKhodakovskiyESI\src\contacts\CharacterContactLabel;
use DenisKhodakovskiyESI\src\contracts\CharacterContract;
use DenisKhodakovskiyESI\src\fleets\CharacterFleet;

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

    /**
     * Get 50 event summaries from the calendar. If no from_event ID is given, the resource will return the next 50 chronological event summaries from now. If a from_event ID is specified, it will return the next 50 chronological event summaries from after that event
     * @param null $fromEvent
     * @return CharacterCalendarEvent[]
     * @throws \Exception
     */
    public function calendarEvents($fromEvent = null)
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $params = ['token' => $this->token];
        if ($fromEvent) {
            $params['from_event'] = $fromEvent;
        }
        $data = (new Request("/characters/{$this->characterId}/calendar/"))
            ->setData($params)
            ->execute();

        foreach ($data as &$event) {
            $event = new CharacterCalendarEvent($event);
        }

        return $data;
    }

    /**
     * Get all invited attendees for a given event
     * @param $eventId
     * @return CharacterCalendarEventAttendee[]
     * @throws \Exception
     */
    public function calendarEventAttendees($eventId)
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $data = (new Request("/characters/{$this->characterId}/calendar/{$eventId}/attendees/"))
            ->setData(['token' => $this->token])
            ->execute();

        foreach ($data as &$attendee) {
            $attendee = new CharacterCalendarEventAttendee($attendee);
        }

        return $data;
    }

    /**
     * Set your response status to an event
     * @param $eventId
     * @param $response
     * @return bool
     * @throws \Exception
     */
    public function respondToCalendarEvent($eventId, $response)
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        if (!in_array($response, [
            CharacterCalendarEvent::EVENT_RESPONSE_ACCEPTED,
            CharacterCalendarEvent::EVENT_RESPONSE_DECLINED,
            CharacterCalendarEvent::EVENT_RESPONSE_TENTATIVE,
        ])) {
            return false;
        }

        (new Request("/characters/{$this->characterId}/calendar/{$eventId}/?token={$this->token}"))
            ->setType(Request::TYPE_PUT)
            ->setData(json_encode(['response' => $response]))
            ->execute();

        return true;
    }

    /**
     * Get all the information for a specific event
     * @param $eventId
     * @return CharacterCalendarEventInfo
     * @throws \Exception
     */
    public function eventInfo($eventId)
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $data = (new Request("/characters/{$this->characterId}/calendar/{$eventId}/"))
            ->setData(['token' => $this->token])
            ->execute();

        return new CharacterCalendarEventInfo($data);
    }

    /**
     * Return a list of agents research information for a character. The formula for finding the current research points with an agent is: currentPoints = remainderPoints + pointsPerDay * days(currentTime - researchStartDate)
     * @return CharacterAgentsResearch[]
     * @throws \Exception
     */
    public function agentsResearch()
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $data = (new Request("/characters/{$this->characterId}/agents_research/"))
            ->setData(['token' => $this->token])
            ->execute();

        foreach ($data as &$research) {
            $research = new CharacterAgentsResearch($research);
        }

        return $data;
    }

    /**
     * Return a list of blueprints the character owns
     * @param int $page
     * @return CharacterBlueprint[]
     * @throws \Exception
     */
    public function blueprints($page = 1)
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $data = (new Request("/characters/{$this->characterId}/blueprints/"))
            ->setData(['token' => $this->token])
            ->execute();

        foreach ($data as &$blueprint) {
            $blueprint = new CharacterBlueprint($blueprint);
        }

        return $data;
    }

    /**
     * Return a character’s jump activation and fatigue information
     * @return CharacterJumpFatigue
     * @throws \Exception
     */
    public function jumpFatigue()
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $data = (new Request("/characters/{$this->characterId}/fatigue/"))
            ->setData(['token' => $this->token])
            ->execute();

        return new CharacterJumpFatigue($data);
    }

    /**
     * Return a list of medals the character has
     * @return CharacterMedal[]
     * @throws \Exception
     */
    public function medals()
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $data = (new Request("/characters/{$this->characterId}/medals/"))
            ->setData(['token' => $this->token])
            ->execute();

        foreach ($data as &$medal) {
            $medal = new CharacterMedal($medal);
        }

        return $data;
    }

    /**
     * Return character notifications
     * @return CharacterNotification[]
     * @throws \Exception
     */
    public function notifications()
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $data = (new Request("/characters/{$this->characterId}/notifications/"))
            ->setData(['token' => $this->token])
            ->execute();

        foreach ($data as &$notification) {
            $notification = new CharacterNotification($notification);
        }

        return $data;
    }

    /**
     * Return notifications about having been added to someone’s contact list
     * @return CharacterContactNotification[]
     * @throws \Exception
     */
    public function contactsNotifications()
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $data = (new Request("/characters/{$this->characterId}/notifications/contacts/"))
            ->setData(['token' => $this->token])
            ->execute();

        foreach ($data as &$notification) {
            $notification = new CharacterContactNotification($notification);
        }

        return $data;
    }

    /**
     * Returns a character’s corporation roles
     * @return CharacterRoles
     * @throws \Exception
     */
    public function roles()
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $data = (new Request("/characters/{$this->characterId}/roles/"))
            ->setData(['token' => $this->token])
            ->execute();

        return new CharacterRoles($data);
    }

    /**
     * Return character standings from agents, NPC corporations, and factions
     * @return CharacterStanding[]
     * @throws \Exception
     */
    public function standings()
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $data = (new Request("/characters/{$this->characterId}/standings/"))
            ->setData(['token' => $this->token])
            ->execute();

        foreach ($data as &$standing) {
            $standing = new CharacterStanding($standing);
        }

        return $data;
    }

    /**
     * Returns a character’s titles
     * @return CharacterTitle[]
     * @throws \Exception
     */
    public function titles()
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $data = (new Request("/characters/{$this->characterId}/titles/"))
            ->setData(['token' => $this->token])
            ->execute();

        foreach ($data as &$title) {
            $title = new CharacterTitle($title);
        }

        return $data;
    }

    /**
     * Return implants on the active clone of a character
     * @return CharacterClones
     * @throws \Exception
     */
    public function clones()
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $data = (new Request("/characters/{$this->characterId}/clones/"))
            ->setData(['token' => $this->token])
            ->execute();

        return new CharacterClones($data);
    }

    /**
     * Return implants on the active clone of a character
     * @return int[]
     * @throws \Exception
     */
    public function implants()
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        return (new Request("/characters/{$this->characterId}/implants/"))
            ->setData(['token' => $this->token])
            ->execute();
    }

    /**
     * Return contacts of a character
     * @param int $page
     * @return CharacterContact[]
     * @throws \Exception
     */
    public function contacts($page = 1)
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $contacts = (new Request("/characters/{$this->characterId}/contacts/"))
            ->setData([
                'token' => $this->token,
                'page' => $page,
            ])
            ->execute();

        foreach ($contacts as &$contact) {
            $contact = new CharacterContact($contact);
        }

        return $contacts;
    }

    /**
     * Bulk delete contacts
     * @param int[] $contactsIds
     * @throws \Exception
     * @return bool
     */
    public function deleteContacts(array $contactsIds)
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        (new Request("/characters/{$this->characterId}/contacts/?" . http_build_query([
                'token' => $this->token,
                'contact_ids' => implode(',', $contactsIds)
            ])))
            ->setType(Request::TYPE_DELETE)
            ->execute();

        return true;
    }

    /**
     * Bulk add contacts with same settings
     * @param int[] $contactsIds
     * @param float $standing
     * @param bool $watched
     * @param int[] $labelIds
     * @return bool
     * @throws \Exception
     */
    public function addContacts(array $contactsIds, $standing, $watched = false, array $labelIds = null)
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $params = [
            'token' => $this->token,
            'standing' => $standing,
        ];
        if ($watched) {
            $params['watched'] = $watched;
        }
        if ($labelIds) {
            $params['label_ids'] = $labelIds;
        }

        (new Request("/characters/{$this->characterId}/contacts/?" . http_build_query($params)))
            ->setType(Request::TYPE_POST)
            ->setData(json_encode($contactsIds))
            ->execute();

        return true;
    }

    /**
     * Bulk edit contacts with same settings
     * @param int[] $contactsIds
     * @param $standing
     * @param bool $watched
     * @param int[] $labelIds
     * @return bool
     * @throws \Exception
     */
    public function editContacts(array $contactsIds, $standing, $watched = false, array $labelIds = null)
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $params = [
            'token' => $this->token,
            'standing' => $standing,
        ];
        if ($watched) {
            $params['watched'] = $watched;
        }
        if ($labelIds) {
            $params['label_ids'] = $labelIds;
        }

        (new Request("/characters/{$this->characterId}/contacts/?" . http_build_query($params)))
            ->setType(Request::TYPE_PUT)
            ->setData(json_encode($contactsIds))
            ->execute();

        return true;
    }

    /**
     * Return custom labels for a character’s contacts
     * @return CharacterContactLabel[]
     * @throws \Exception
     */
    public function contactsLabels()
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $labels = (new Request("/characters/{$this->characterId}/contacts/labels/"))
            ->setData([
                'token' => $this->token,
            ])
            ->execute();

        foreach ($labels as &$label) {
            $label = new CharacterContactLabel($label);
        }

        return $labels;
    }

    /**
     * Returns contracts available to a character, only if the character is issuer, acceptor or assignee. Only returns contracts no older than 30 days, or if the status is "in_progress".
     * @param int $page
     * @return CharacterContract[]
     * @throws \Exception
     */
    public function contracts($page = 1)
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        $contracts = (new Request("/characters/{$this->characterId}/contracts/"))
            ->setData([
                'token' => $this->token,
                'page' => $page,
            ])
            ->execute();

        foreach ($contracts as &$contract) {
            $contract = new CharacterContract($contract, $this->characterId, $this->token);
        }

        return $contracts;
    }

    /**
     * Return the fleet ID the character is in, if any.
     * @return CharacterFleet|null
     * @throws \Exception
     */
    public function fleet()
    {
        $this->isIdProvided();
        $this->isTokenProvided();

        try {
            $fleet = (new Request("/characters/{$this->characterId}/fleet/"))
                ->setData(['token' => $this->token])
                ->execute();

            return new CharacterFleet($fleet, $this->token);
        } catch (\Exception $exception) {
            return null;
        }
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
