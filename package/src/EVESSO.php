<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 29.09.18
 * Time: 13:34
 */

namespace DenisKhodakovskiyESI\src;

use DenisKhodakovskiyESI\src\sso\SSOVerify;
use DenisKhodakovskiyESI\src\sso\SSOToken;

class EVESSO
{
    private $clientId;
    private $secretKey;
    private $redirectUri;
    private $host = 'https://login.eveonline.com/oauth';

    public function __construct($clientId, $secretKey, $callback)
    {
        $this->clientId = $clientId;
        $this->secretKey = $secretKey;
        $this->redirectUri = $callback;
    }

    /**
     * Generates an auth url for selected scopes
     * @param array $scopes
     * @return string
     */
    public function getAuthUrl(array $scopes)
    {
        return "{$this->host}/authorize?" . http_build_query([
            'response_type' => 'code',
            'redirect_uri' => $this->redirectUri,
            'client_id' => $this->clientId,
            'scope' => implode(' ', $scopes)
        ]);
    }

    /**
     * @param $code
     * @return SSOToken
     * @throws \Exception
     */
    public function getAccessToken($code)
    {
        $base64 = base64_encode("{$this->clientId}:{$this->secretKey}");
        $response = (new Request("{$this->host}/token"))
            ->setType(Request::TYPE_POST)
            ->setData([
                'grant_type' => 'authorization_code',
                'code' => $code
            ])
            ->setHeader(["Authorization: Basic {$base64}"])
            ->execute();

        return new SSOToken($response);
    }

    /**
     * @param $refreshToken
     * @return SSOToken
     * @throws \Exception
     */
    public function refreshToken($refreshToken)
    {
        $base64 = base64_encode("{$this->clientId}:{$this->secretKey}");
        $response = (new Request("{$this->host}/token"))
            ->setType(Request::TYPE_POST)
            ->setData([
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
            ])
            ->setHeader(["Authorization: Basic {$base64}"])
            ->execute();

        return new SSOToken($response);
    }

    /**
     * @param $accessToken
     * @return SSOVerify
     * @throws \Exception
     */
    public function verify($accessToken)
    {
        $response = (new Request("{$this->host}/verify"))
            ->setHeader(["Authorization: Bearer {$accessToken}"])
            ->execute();

        return new SSOVerify($response);
    }

    /**
     * @param $accessToken
     * @return Character
     * @throws \Exception
     */
    public function getCharacter($accessToken)
    {
        $verify = $this->verify($accessToken);

        return new Character($verify->characterID, $accessToken);
    }

    /**
     * @return array
     */
    public function getScopesList()
    {
        return [
            'esi-calendar.respond_calendar_events.v1',
            'esi-calendar.read_calendar_events.v1',
            'esi-location.read_location.v1',
            'esi-location.read_ship_type.v1',
            'esi-mail.organize_mail.v1',
            'esi-mail.read_mail.v1',
            'esi-mail.send_mail.v1',
            'esi-skills.read_skills.v1',
            'esi-skills.read_skillqueue.v1',
            'esi-wallet.read_character_wallet.v1',
            'esi-wallet.read_corporation_wallet.v1',
            'esi-search.search_structures.v1',
            'esi-clones.read_clones.v1',
            'esi-characters.read_contacts.v1',
            'esi-universe.read_structures.v1',
            'esi-bookmarks.read_character_bookmarks.v1',
            'esi-killmails.read_killmails.v1',
            'esi-corporations.read_corporation_membership.v1',
            'esi-assets.read_assets.v1',
            'esi-planets.manage_planets.v1',
            'esi-fleets.read_fleet.v1',
            'esi-fleets.write_fleet.v1',
            'esi-ui.open_window.v1',
            'esi-ui.write_waypoint.v1',
            'esi-characters.write_contacts.v1',
            'esi-fittings.read_fittings.v1',
            'esi-fittings.write_fittings.v1',
            'esi-markets.structure_markets.v1',
            'esi-corporations.read_structures.v1',
            'esi-corporations.write_structures.v1',
            'esi-characters.read_loyalty.v1',
            'esi-characters.read_opportunities.v1',
            'esi-characters.read_chat_channels.v1',
            'esi-characters.read_medals.v1',
            'esi-characters.read_standings.v1',
            'esi-characters.read_agents_research.v1',
            'esi-industry.read_character_jobs.v1',
            'esi-markets.read_character_orders.v1',
            'esi-characters.read_blueprints.v1',
            'esi-characters.read_corporation_roles.v1',
            'esi-location.read_online.v1',
            'esi-contracts.read_character_contracts.v1',
            'esi-clones.read_implants.v1',
            'esi-characters.read_fatigue.v1',
            'esi-killmails.read_corporation_killmails.v1',
            'esi-corporations.track_members.v1',
            'esi-wallet.read_corporation_wallets.v1',
            'esi-characters.read_notifications.v1',
            'esi-corporations.read_divisions.v1',
            'esi-corporations.read_contacts.v1',
            'esi-assets.read_corporation_assets.v1',
            'esi-corporations.read_titles.v1',
            'esi-corporations.read_blueprints.v1',
            'esi-bookmarks.read_corporation_bookmarks.v1',
            'esi-contracts.read_corporation_contracts.v1',
            'esi-corporations.read_standings.v1',
            'esi-corporations.read_starbases.v1',
            'esi-industry.read_corporation_jobs.v1',
            'esi-markets.read_corporation_orders.v1',
            'esi-corporations.read_container_logs.v1',
            'esi-industry.read_character_mining.v1',
            'esi-industry.read_corporation_mining.v1',
            'esi-planets.read_customs_offices.v1',
            'esi-corporations.read_facilities.v1',
            'esi-corporations.read_medals.v1',
            'esi-characters.read_titles.v1',
            'esi-alliances.read_contacts.v1',
            'esi-characters.read_fw_stats.v1',
            'esi-corporations.read_fw_stats.v1',
            'esi-corporations.read_outposts.v1',
            'esi-characterstats.read.v1',
        ];
    }
}
