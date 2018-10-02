<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.10.18
 * Time: 9:23
 */

namespace DenisKhodakovskiyESI\src\fleets;

use DenisKhodakovskiyESI\src\Request;

class FleetInvitation
{
    /**
     * @var int
     */
    public $characterId;

    /**
     * @var string
     */
    public $role;

    /**
     * @var int
     */
    public $squadId;

    /**
     * @var int
     */
    public $wingId;

    private $fleetId;
    private $token;

    /**
     * FleetInvitation constructor.
     * @param $fleetId
     * @param $token
     * @param string $role
     */
    public function __construct($fleetId, $token, $role = CharacterFleet::ROLE_SQUAD_MEMBER)
    {
        $this->fleetId = $fleetId;
        $this->token = $token;

        $this->role = $role;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function validate()
    {
        if (!$this->role) {
            throw new \Exception("Fleet role should be specified");
        }

        if (!in_array($this->role, [
            CharacterFleet::ROLE_FLEET_COMMANDER,
            CharacterFleet::ROLE_WING_COMMANDER,
            CharacterFleet::ROLE_SQUAD_COMMANDER,
            CharacterFleet::ROLE_SQUAD_MEMBER,
        ])) {
            throw new \Exception("Unknown fleet role");
        }

        if ($this->role == CharacterFleet::ROLE_WING_COMMANDER && !$this->wingId) {
            throw new \Exception("Wing Id should be specified");
        }

        if ($this->role == CharacterFleet::ROLE_SQUAD_COMMANDER && (!$this->wingId || !$this->squadId)) {
            throw new \Exception("Wing Id and squad Id should be specified");
        }

        if ($this->role == CharacterFleet::ROLE_SQUAD_MEMBER && (($this->squadId xor $this->wingId))) {
            throw new \Exception("Wing Id and squad Id should either both be specified or not specified at all");
        }

        return true;
    }

    public function send()
    {
        (new Request("/fleets/{$this->fleetId}/members/?token={$this->token}"))
            ->setType(Request::TYPE_POST)
            ->setData(json_encode([
                'character_id' => $this->characterId,
                'squad_id' => $this->squadId,
                'wing_id' => $this->wingId,
                'role' => $this->role,
            ]));

        return true;
    }
}
