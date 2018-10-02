<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.10.18
 * Time: 12:34
 */

namespace DenisKhodakovskiyESI\src\mail;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterMailRecipient extends BaseObject
{
    /**
     * @var int
     */
    public $recipientId;

    /**
     * @var string
     */
    public $recipientType;

    const TYPE_ALLIANCE = 'alliance';
    const TYPE_CHARACTER = 'character';
    const TYPE_CORPORATION = 'corporation';
    const TYPE_MAILING_LIST = 'mailing_list';
}
