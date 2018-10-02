<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 12:44
 */

namespace DenisKhodakovskiyESI\src\alliance;

use DenisKhodakovskiyESI\src\BaseObject;

class AllianceContact extends BaseObject
{
    /**
     * @var int
     */
    public $contactId;

    /**
     * @var string
     */
    public $contactType;

    /**
     * @var array
     */
    public $labelIds;

    /**
     * @var float
     */
    public $standing;
}
