<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 01.10.18
 * Time: 11:44
 */

namespace DenisKhodakovskiyESI\src\character;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterMedal extends BaseObject
{
    const STATUS_PUBLIC = 'public';
    const STATUS_PRIVATE = 'private';

    /**
     * @var int
     */
    public $corporationId;

    /**
     * @var \DateTime
     */
    public $date;

    /**
     * @var string
     */
    public $description;

    /**
     * @var MedalGraphics[]
     */
    public $graphics;

    /**
     * @var int
     */
    public $issuerId;

    /**
     * @var int
     */
    public $medalId;

    /**
     * @var string
     */
    public $reason;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $title;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->date = new \DateTime($this->date);
        foreach ($this->graphics as &$graphic) {
            $graphic = new MedalGraphics($graphic);
        }
    }
}
