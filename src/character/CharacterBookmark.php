<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 30.09.18
 * Time: 12:21
 */

namespace DenisKhodakovskiyESI\src\character;

use DenisKhodakovskiyESI\src\BaseObject;

class CharacterBookmark extends BaseObject
{
    /**
     * @var int
     */
    public $bookmarkId;

    /**
     * @var array
     */
    public $coordinates;

    /**
     * @var \DateTime
     */
    public $created;

    /**
     * @var int
     */
    public $creatorId;

    /**
     * @var int
     */
    public $folderId;

    /**
     * @var CharacterBookmarkItem
     */
    public $item;

    /**
     * @var string
     */
    public $label;

    /**
     * @var int
     */
    public $locationId;

    /**
     * @var string
     */
    public $notes;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->created = new \DateTime(($this->created));
        if ($this->item) {
            $this->item = new CharacterBookmarkItem($this->item);
        }
    }
}
