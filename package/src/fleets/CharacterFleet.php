<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 01.10.18
 * Time: 17:39
 */

namespace DenisKhodakovskiyESI\src\fleets;

use DenisKhodakovskiyESI\src\BaseObject;
use DenisKhodakovskiyESI\src\Request;

class CharacterFleet extends BaseObject
{
    const ROLE_FLEET_COMMANDER = 'fleet_commander';
    const ROLE_SQUAD_COMMANDER = 'squad_commander';
    const ROLE_WING_COMMANDER  = 'wing_commander';
    const ROLE_SQUAD_MEMBER    = 'squad_member';

    /**
     * @var int
     */
    public $fleetId;

    /**
     * @var string
     */
    public $role;

    /**
     * ID of the squad the member is in. If not applicable, will be set to -1
     * @var int
     */
    public $squadId;

    /**
     * ID of the wing the member is in. If not applicable, will be set to -1
     * @var int
     */
    public $wingId;

    /**
     * Is free-move enabled
     * @var bool
     */
    public $isFreeMove;

    /**
     * Does the fleet have an active fleet advertisement
     * @var bool
     */
    public $isRegistered;

    /**
     * Is EVE Voice enabled
     * @var bool
     */
    public $isVoiceEnabled;

    /**
     * @var string
     */
    public $motd;

    private $token;

    /**
     * CharacterFleet constructor.
     * @param $data
     * @param $token
     * @throws \Exception
     */
    public function __construct($data, $token)
    {
        parent::__construct($data);
        $this->token = $token;

        $data = (new Request("/fleets/{$this->fleetId}/"))
            ->setData(['token' => $this->token])
            ->execute();

        foreach ($data as $key => $value) {
            $key = lcfirst(str_replace('_', '', ucwords($key, '_')));
            $this->{$key} = $value;
        }
    }

    /**
     * Update settings about a fleet
     * @return bool
     * @throws \Exception
     */
    public function update()
    {
        if (!$this->token) {
            throw new \Exception('Token should be provided');
        }

        (new Request("/fleets/{$this->fleetId}/?token={$this->token}"))
            ->setType(Request::TYPE_PUT)
            ->setData(json_encode([
                'is_free_move' => $this->isFreeMove,
                'motd' => $this->motd,
            ]))
            ->execute();

        return true;
    }

    /**
     * Return information about fleet members
     * @return CharacterFleetMember[]
     * @throws \Exception
     */
    public function members()
    {
        if (!$this->token) {
            throw new \Exception('Token should be provided');
        }

        $members = (new Request("/fleets/{$this->fleetId}/members/?token={$this->token}"))
            ->execute();

        foreach ($members as &$member) {
            $member = new CharacterFleetMember($member);
        }

        return $members;
    }

    /**
     * Returns a fleet invite instance
     * @param string $role
     * @return FleetInvitation
     */
    public function createInvite($role = self::ROLE_SQUAD_MEMBER)
    {
        return new FleetInvitation($this->fleetId, $this->token, $role);
    }

    /**
     * Kick a fleet member
     * @param int $characterId
     * @return bool
     * @throws \Exception
     */
    public function kickMember($characterId)
    {
        (new Request("/fleets/{$this->fleetId}/members/{$characterId}/?token={$this->token}"))
            ->setType(Request::TYPE_DELETE)
            ->execute();

        return true;
    }

    /**
     * Move a fleet member around
     * @param int $characterId
     * @param string $role
     * @param null|int $wingId
     * @param null|int $squadId
     * @return bool
     * @throws \Exception
     */
    public function moveMember($characterId, $role, $wingId = null, $squadId = null)
    {
        if ($role == CharacterFleet::ROLE_WING_COMMANDER && !$wingId) {
            throw new \Exception("Wing Id should be specified");
        }

        if ($role == CharacterFleet::ROLE_SQUAD_COMMANDER && (!$wingId || !$squadId)) {
            throw new \Exception("Wing Id and squad Id should be specified");
        }

        if ($role == CharacterFleet::ROLE_SQUAD_MEMBER && (($squadId xor $wingId))) {
            throw new \Exception("Wing Id and squad Id should either both be specified or not specified at all");
        }

        (new Request("/fleets/{$this->fleetId}/members/{$characterId}/?token={$this->token}"))
            ->setType(Request::TYPE_PUT)
            ->setData(json_encode([
                'role' => $role,
                'wing_id' => $wingId,
                'squad_id' => $squadId,
            ]))
            ->execute();

        return true;
    }

    /**
     * Delete a fleet squad, only empty squads can be deleted
     * @param int $squadId
     * @return bool
     * @throws \Exception
     */
    public function deleteSquad($squadId)
    {
        (new Request("/fleets/{$this->fleetId}/squads/{$squadId}/?token={$this->token}"))
            ->setType(Request::TYPE_DELETE)
            ->execute();

        return true;
    }

    /**
     * Rename a fleet squad
     * @param int $squadId
     * @param string $name
     * @return bool
     * @throws \Exception
     */
    public function renameSquad($squadId, $name)
    {
        (new Request("/fleets/{$this->fleetId}/squads/{$squadId}/?token={$this->token}"))
            ->setType(Request::TYPE_PUT)
            ->setData(json_encode(['name' => $name]))
            ->execute();

        return true;
    }

    /**
     * Return information about wings in a fleet
     * @return CharacterFleetWings[]
     * @throws \Exception
     */
    public function wings()
    {
        $wings = (new Request("/fleets/{fleet_id}/wings/"))
            ->setData(['token' => $this->token])
            ->execute();

        foreach ($wings as &$wing) {
            $wing = new CharacterFleetWings($wing);
        }

        return $wings;
    }

    /**
     * Create a new wing in a fleet
     * @return bool
     * @throws \Exception
     */
    public function createWing()
    {
        (new Request("/fleets/{$this->fleetId}/wings/?token={$this->token}"))
            ->setType(Request::TYPE_POST)
            ->execute();

        return true;
    }

    /**
     * Delete a fleet wing, only empty wings can be deleted. The wing may contain squads, but the squads must be empty
     * @param int $wingId
     * @return bool
     * @throws \Exception
     */
    public function deleteWing($wingId)
    {
        (new Request("/fleets/{$this->fleetId}/wings/{$wingId}/?token={$this->token}"))
            ->setType(Request::TYPE_DELETE)
            ->execute();

        return true;
    }

    /**
     * Rename a fleet wing
     * @param int $wingId
     * @param string $name
     * @return bool
     * @throws \Exception
     */
    public function renameWing($wingId, $name)
    {
        (new Request("/fleets/{$this->fleetId}/wings/{$wingId}/?token={$this->token}"))
            ->setType(Request::TYPE_PUT)
            ->setData(json_encode(['name' => $name]))
            ->execute();

        return true;
    }

    /**
     * Create a new squad in a fleet
     * @param int $wingId
     * @return bool
     * @throws \Exception
     */
    public function createSquad($wingId)
    {
        (new Request("/fleets/{$this->fleetId}/wings/{$wingId}/squads/?token={$this->token}"))
            ->setType(Request::TYPE_POST)
            ->execute();

        return true;
    }
}
