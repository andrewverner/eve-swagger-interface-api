<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 29.09.18
 * Time: 21:58
 */

namespace DenisKhodakovskiyESI\src\sso;

use DenisKhodakovskiyESI\src\BaseObject;

class SSOToken extends BaseObject
{
    /**
     * @var string
     */
    public $accessToken;

    /**
     * @var string
     */
    public $tokenType;

    /**
     * @var int
     */
    public $expiresIn;

    /**
     * @var string
     */
    public $refreshToken;
}
