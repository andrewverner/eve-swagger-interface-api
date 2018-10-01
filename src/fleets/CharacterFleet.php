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
}
