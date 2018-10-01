<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 01.10.18
 * Time: 16:33
 */

namespace DenisKhodakovskiyESI\src\contracts;

use DenisKhodakovskiyESI\src\Request;

class CharacterContract extends PublicRegionContract
{
    /**
     * @var int
     */
    public $acceptorId;

    /**
     * @var int
     */
    public $assigneeId;

    /**
     * @var string
     */
    public $availability;

    /**
     * @var \DateTime
     */
    public $dateAccepted;

    /**
     * @var \DateTime
     */
    public $dateCompleted;

    /**
     * @var string
     */
    public $status;

    /**
     * @var CharacterContractBid[]
     */
    private $bids;

    /**
     * @var CharacterContractItem[]
     */
    private $items;

    private $token;
    private $characterId;

    const AVAILABILITY_CORPORATION = 'corporation';
    const AVAILABILITY_PERSONAL    = 'personal';
    const AVAILABILITY_ALLIANCE    = 'alliance';
    const AVAILABILITY_PUBLIC      = 'public';

    const STATUS_FINISHED_CONTRACTOR = 'finished_contractor';
    const STATUS_FINISHED_ISSUER     = 'finished_issuer';
    const STATUS_OUTSTANDING         = 'outstanding';
    const STATUS_IN_PROGRESS         = 'in_progress';
    const STATUS_CANCELLED           = 'cancelled';
    const STATUS_FINISHED            = 'finished';
    const STATUS_REJECTED            = 'rejected';
    const STATUS_REVERSED            = 'reversed';
    const STATUS_DELETED             = 'deleted';
    const STATUS_FAILED              = 'failed';

    public function __construct($data, $characterId, $token)
    {
        parent::__construct($data);
        if ($this->dateAccepted) {
            $this->dateAccepted = new \DateTime($this->dateAccepted);
        }
        if ($this->dateCompleted) {
            $this->dateCompleted = new \DateTime($this->dateCompleted);
        }

        $this->token = $token;
        $this->characterId = $characterId;
    }

    /**
     * Lists bids on a particular auction contract
     * @return CharacterContractBid[]
     * @throws \Exception
     */
    public function bids()
    {
        if ($this->type != self::TYPE_AUCTION) {
            return [];
        }

        if (!$this->bids) {
            $data = (new Request("/characters/{$this->characterId}/contracts/{$this->contractId}/bids/"))
                ->setData(['token' => $this->token])
                ->execute();
            foreach ($data as &$bid) {
                $bid = new CharacterContractBid($bid);
            }

            $this->bids = $data;
        }

        return $this->bids;
    }

    /**
     * Lists items of a particular contract
     * @return CharacterContractItem[]
     * @throws \Exception
     */
    public function items()
    {
        if (!$this->items) {
            $data = (new Request("/characters/{$this->characterId}/contracts/{$this->contractId}/items/"))
                ->setData(['token' => $this->token])
                ->execute();
            foreach ($data as &$item) {
                $item = new CharacterContractItem($item);
            }

            $this->items = $data;
        }

        return $this->items;
    }
}
