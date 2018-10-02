<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 28.09.18
 * Time: 12:06
 */

namespace DenisKhodakovskiyESI\src;

use DenisKhodakovskiyESI\src\character\BulkCharacterLookupRecord;
use DenisKhodakovskiyESI\src\contracts\PublicRegionContract;
use DenisKhodakovskiyESI\src\incursions\Incursion;
use DenisKhodakovskiyESI\src\industry\IndustryFacility;
use DenisKhodakovskiyESI\src\industry\IndustrySystem;
use DenisKhodakovskiyESI\src\insurance\InsurancePrice;

class EVE
{
    /**
     * @var int[]
     */
    private $alliancesList;

    /**
     * @var int[]
     */
    private $npcCorporationsList;

    /**
     * @var Incursion[]
     */
    private $incursions;

    /**
     * @var IndustryFacility[]
     */
    private $industryFacilities;

    /**
     * @var IndustrySystem[]
     */
    private $industrySystems;

    /**
     * @var InsurancePrice[]
     */
    private $insurancePrizes;

    /**
     * Returns an array of alliances Ids
     * @return int[]
     * @throws \Exception
     */
    public function alliancesList()
    {
        if (!$this->alliancesList) {
            $this->alliancesList = (new Request('/alliances/'))
                ->execute();
        }

        return $this->alliancesList;
    }

    /**
     * Bulk characters lookup
     * @param array $charactersIds
     * @return BulkCharacterLookupRecord[]
     * @throws \Exception
     */
    public function bulkCharactersLookup(array $charactersIds)
    {
        $data = (new Request('/characters/affiliation/', Request::TYPE_POST))
            ->setData(json_encode($charactersIds))
            ->execute();
        foreach ($data as &$record) {
            $record = new BulkCharacterLookupRecord($record);
        }

        return $data;
    }

    /**
     * Returns a list of public contracts in by a region Id
     * @param $regionId
     * @return PublicRegionContract[]
     * @throws \Exception
     */
    public function publicRegionContracts($regionId)
    {
        $data = (new Request("/contracts/public/{$regionId}/"))
            ->execute();
        foreach ($data as &$contract) {
            $contract = new PublicRegionContract($contract);
        }

        return $data;
    }

    /**
     * Returns an array of NPC corporations Ids
     * @return int[]
     * @throws \Exception
     */
    public function npcCorporations()
    {
        if (!$this->npcCorporationsList) {
            $this->npcCorporationsList = (new Request('/corporations/npccorps/'))
                ->execute();
        }

        return $this->npcCorporationsList;
    }

    /**
     * Returns incursions list
     * @return Incursion[]
     * @throws \Exception
     */
    public function incursions()
    {
        if (!$this->incursions) {
            $data = (new Request("/incursions/"))
                ->execute();
            foreach ($data as &$incursion) {
                $incursion = new Incursion($incursion);
            }

            $this->incursions = $data;
        }

        return $this->incursions;
    }

    /**
     * Lists industry facilities
     * @return IndustryFacility[]
     * @throws \Exception
     */
    public function industryFacilities()
    {
        if (!$this->industryFacilities) {
            $data = (new Request('/industry/facilities/'))
                ->execute();
            foreach ($data as &$facility) {
                $this->industryFacilities[] = new IndustryFacility($facility);
            }

            $this->industryFacilities = $data;
        }

        return $this->industryFacilities;
    }

    /**
     * Lists industry systems
     * @return IndustrySystem[]
     * @throws \Exception
     */
    public function industrySystems()
    {
        if (!$this->industrySystems) {
            $data = (new Request('/industry/systems/'))
                ->execute();
            foreach ($data as &$system) {
                $system = new IndustrySystem($system);
            }

            $this->industrySystems = $data;
        }

        return $this->industrySystems;
    }

    /**
     * Return available insurance levels for all ship types
     * @return InsurancePrice[]
     * @throws \Exception
     */
    public function insurancePrizes()
    {
        if (!$this->insurancePrizes) {
            $data = (new Request('/insurance/prices/'))
                ->execute();
            foreach ($data as &$price) {
                $price = new InsurancePrice($price);
            }

            $this->insurancePrizes = $data;
        }

        return $this->insurancePrizes;
    }
}
