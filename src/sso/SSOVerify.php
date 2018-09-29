<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 29.09.18
 * Time: 22:06
 */

namespace DenisKhodakovskiyESI\src\sso;

use DenisKhodakovskiyESI\src\BaseObject;

class SSOVerify extends BaseObject
{
    /**
     * @var int
     */
    public $characterID;

    /**
     * @var string
     */
    public $characterName;

    /**
     * @var \DateTime
     */
    public $expiresOn;

    /**
     * @var array
     */
    public $scopes;

    /**
     * @var string
     */
    public $tokenType;

    /**
     * @var string
     */
    public $characterOwnerHash;

    /**
     * @var string
     */
    public $intellectualProperty;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->expiresOn = new \DateTime($this->expiresOn);
        $this->scopes = explode(' ', $this->scopes);
    }
}
