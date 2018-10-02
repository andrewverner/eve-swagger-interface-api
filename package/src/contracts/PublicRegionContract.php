<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 14:00
 */

namespace DenisKhodakovskiyESI\src\contracts;

use DenisKhodakovskiyESI\src\BaseObject;
use DenisKhodakovskiyESI\src\Request;

class PublicRegionContract extends BaseObject
{
    /**
     * Buyout price (for auction only)
     * @var float
     */
    public $buyout;

    /**
     * Collateral price (for Couriers only)
     * @var float
     */
    public $collateral;

    /**
     * @var int
     */
    public $contractId;

    /**
     * Expiration date of the contract
     * @var \DateTime
     */
    public $dateExpired;

    /**
     * Сreation date of the contract
     * @var \DateTime
     */
    public $dateIssued;

    /**
     * Number of days to perform the contract
     * @var int
     */
    public $daysToComplete;

    /**
     * End location ID (for Couriers contract)
     * @var int
     */
    public $endLocationId;

    /**
     * true if the contract was issued on behalf of the issuer’s corporation
     * @var bool
     */
    public $forCorporation;

    /**
     * Character’s corporation ID for the issuer
     * @var int
     */
    public $issuerCorporationId;

    /**
     * Character ID for the issuer
     * @var int
     */
    public $issuerId;

    /**
     * Price of contract (for ItemsExchange and Auctions)
     * @var float
     */
    public $price;

    /**
     * Remuneration for contract (for Couriers only)
     * @var float
     */
    public $reward;

    /**
     * Start location ID (for Couriers contract)
     * @var int
     */
    public $startLocationId;

    /**
     * Title of the contract
     * @var string
     */
    public $title;

    /**
     * Type of the contract
     * @var string
     */
    public $type;

    /**
     * Volume of items in the contract
     * @var float
     */
    public $volume;

    /**
     * List of contract bids (for auction type only)
     * @var PublicContractBid[]
     */
    private $bids;

    /**
     * List of contract items
     * @var PublicContractItem[]
     */
    private $items;

    const TYPE_LOAN          = 'loan';
    const TYPE_UNKNOWN       = 'unknown';
    const TYPE_AUCTION       = 'auction';
    const TYPE_COURIER       = 'courier';
    const TYPE_ITEM_EXCHANGE = 'item_exchange';

    public function __construct($data)
    {
        parent::__construct($data);
        $this->dateExpired = new \DateTime($this->dateExpired);
        $this->dateIssued = new \DateTime($this->dateIssued);
    }

    /**
     * Returns bids list of a contract (only for an auction)
     * @return PublicContractBid[]
     * @throws \Exception
     */
    public function bids()
    {
        if ($this->type != self::TYPE_AUCTION) {
            return [];
        }

        if (!$this->bids) {
            $data = (new Request("/contracts/public/bids/{$this->contractId}/"))->execute();
            foreach ($data as &$bid) {
                $bid = new PublicContractBid($bid);
            }

            $this->bids = $data;
        }

        return $this->bids;
    }

    /**
     * Returns items list of the contract
     * @return PublicContractItem[]
     * @throws \Exception
     */
    public function items()
    {
        if (!$this->items) {
            $data = (new Request("/contracts/public/items/{$this->contractId}/"))->execute();
            foreach ($data as &$item) {
                $item = new PublicContractItem($item);
            }

            $this->items = $data;
        }

        return $this->items;
    }
}
