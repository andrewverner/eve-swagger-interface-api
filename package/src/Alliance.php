<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 10:26
 */

namespace DenisKhodakovskiyESI\src;

use DenisKhodakovskiyESI\src\alliance\AllianceContact;
use DenisKhodakovskiyESI\src\alliance\AllianceIcons;
use DenisKhodakovskiyESI\src\alliance\PublicAllianceInfo;

class Alliance
{
    /**
     * @var int
     */
    private $allianceId;

    /**
     * @var string
     */
    private $token;

    /**
     * @var PublicAllianceInfo
     */
    private $allianceInfo;

    /**
     * @var int[]
     */
    private $corporationsList;

    /**
     * @var AllianceIcons
     */
    private $icons;

    /**
     * @var AllianceContact[]
     */
    private $contacts;

    public function __construct($allianceId, $token = null)
    {
        $this->allianceId = $allianceId;
        if ($token) {
            $this->token = $token;
        }
    }

    /**
     * Returns information about an alliance by its Id
     * @return PublicAllianceInfo
     * @throws \Exception
     */
    public function allianceInfo()
    {
        if (!$this->allianceInfo) {
            $this->isIdProvided();

            $data = (new Request("/alliances/{$this->allianceId}/"))
                ->execute();
            $this->allianceInfo =  new PublicAllianceInfo($data);
        }

        return $this->allianceInfo;
    }

    /**
     * Returns an array of corporations Ids of the alliance
     * @return int[]|mixed
     * @throws \Exception
     */
    public function corporationsList()
    {
        if (!$this->corporationsList) {
            $this->isIdProvided();

            $this->corporationsList = (new Request("/alliances/{$this->allianceId}/corporations/"))
                ->execute();
        }

        return $this->corporationsList;
    }

    /**
     * Returns alliances icons
     * @return AllianceIcons
     * @throws \Exception
     */
    public function icons()
    {
        if (!$this->icons) {
            $this->isIdProvided();

            $data = (new Request("/alliances/{$this->allianceId}/icons/"))
                ->execute();
            $this->icons =  new AllianceIcons($data);
        }

        return $this->icons;
    }

    /**
     * Returns alliance contacts list
     * @return AllianceContact[]
     * @throws \Exception
     */
    public function contacts()
    {
        if (!$this->contacts) {
            $this->isIdProvided();
            $this->isTokenProvided();

            $data = (new Request("/alliances/{$this->allianceId}/contacts/"))
                ->execute();
            foreach ($data as $contact) {
                $this->contacts[] = new AllianceContact($contact);
            }
        }

        return $this->contacts;
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
        if (!$this->allianceId) {
            throw new \Exception('Alliance Id must be provided', 400);
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
