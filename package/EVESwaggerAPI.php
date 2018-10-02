<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 10:13
 */

namespace DenisKhodakovskiyESI;

use DenisKhodakovskiyESI\src\Alliance;
use DenisKhodakovskiyESI\src\Character;
use DenisKhodakovskiyESI\src\Corporation;
use DenisKhodakovskiyESI\src\EVE;
use DenisKhodakovskiyESI\src\EVESSO;
use DenisKhodakovskiyESI\src\FactionWarfare;
use DenisKhodakovskiyESI\src\Market;
use DenisKhodakovskiyESI\src\Route;

class EVESwaggerAPI
{
    private $clientId;
    private $secretKey;
    private $callback;

    public function __construct($clientId, $secretKey, $callback = '')
    {
        $this->clientId = $clientId;
        $this->secretKey = $secretKey;
        $this->callback = $callback;
    }

    /**
     * Returns an instance of a character class
     * @param int $characterId
     * @param null $token
     * @return Character
     */
    public function character($characterId, $token = null)
    {
        return new Character($characterId, $token);
    }

    /**
     * Returns an instance of a corporation class
     * @param int $corporationId
     * @param null $token
     * @return Corporation
     */
    public function corporation($corporationId, $token = null)
    {
        return new Corporation($corporationId, $token);
    }

    /**
     * Returns an instance of an alliance class
     * @param int $allianceId
     * @param null $token
     * @return Alliance
     */
    public function alliance($allianceId, $token = null)
    {
        return new Alliance($allianceId, $token);
    }

    /**
     * @return EVE
     */
    public function eve()
    {
        return new EVE();
    }

    /**
     * @return FactionWarfare
     */
    public function fw()
    {
        return new FactionWarfare();
    }

    /**
     * @return Market
     */
    public function market()
    {
        return new Market();
    }

    /**
     * @param $fromSolarSystemId
     * @param $toSolarSystemId
     * @param string $flag
     * @return Route
     */
    public function route($fromSolarSystemId, $toSolarSystemId, $flag = Route::FLAG_SHORTEST)
    {
        return new Route($fromSolarSystemId, $toSolarSystemId, $flag);
    }

    /**
     * Return SSO component
     * @return EVESSO
     * @throws \Exception
     */
    public function sso()
    {
        return new EVESSO($this->clientId, $this->secretKey, $this->callback);
    }
}
