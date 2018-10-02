<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 01.10.18
 * Time: 16:00
 */

namespace DenisKhodakovskiyESI\src\contacts;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterContact extends BaseObject
{
    const TYPE_CORPORATION = 'corporation';
    const TYPE_CHARACTER   = 'character';
    const TYPE_ALLIANCE    = 'alliance';
    const TYPE_FACTION     = 'faction';

    /**
     * @var int
     */
    public $contactId;

    /**
     * @var string
     */
    public $contactType;

    /**
     * @var bool
     */
    public $isBlocked;

    /**
     * @var bool
     */
    public $isWatched;

    /**
     * @var int[]
     */
    public $labelIds;

    /**
     * @var float
     */
    public $standing;
}
