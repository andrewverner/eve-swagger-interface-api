<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 13:23
 */

namespace DenisKhodakovskiyESI\src\character;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterPortrait extends BaseObject
{
    /**
     * Path to character portrait 64x64 px
     * @var string
     */
    public $px64x64;

    /**
     * Path to character portrait 128x128 px
     * @var string
     */
    public $px128x128;

    /**
     * Path to character portrait 256x256 px
     * @var string
     */
    public $px256x256;

    /**
     * Path to character portrait 512x512 px
     * @var string
     */
    public $px512x512;
}
