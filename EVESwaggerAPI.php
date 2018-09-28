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
use DenisKhodakovskiyESI\src\FactionWarfare;

class EVESwaggerAPI
{
    /**
     * @var EVE
     */
    public $eve;

    public function __construct()
    {
        $this->eve = new EVE();
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

    public function fw()
    {
        return new FactionWarfare();
    }
}
