<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.10.18
 * Time: 13:47
 */

namespace DenisKhodakovskiyESI\package\src\assets;

use DenisKhodakovskiyESI\src\BaseObject;

class CorporationAsset extends BaseObject
{
    /**
     * @var bool
     */
    public $isBlueprintCopy;

    /**
     * @var bool
     */
    public $isSingleton;

    /**
     * @var int
     */
    public $itemId;

    /**
     * @var string
     */
    public $locationFlag;

    /**
     * @var int
     */
    public $locationId;

    /**
     * @var string
     */
    public $locationType;

    /**
     * @var int
     */
    public $quantity;

    /**
     * @var int
     */
    public $typeId;

    const LOCATION_TYPE_STATION = 'station';
    const LOCATION_TYPE_SOLAR_SYSTEM = 'solar_system';
    const LOCATION_TYPE_OTHER = 'other';

    const LOCATION_FLAG_ASSETSAFETY = 'AssetSafety';
    const LOCATION_FLAG_AUTOFIT = 'AutoFit';
    const LOCATION_FLAG_BONUS = 'Bonus';
    const LOCATION_FLAG_BOOSTER = 'Booster';
    const LOCATION_FLAG_BOOSTERBAY = 'BoosterBay';
    const LOCATION_FLAG_CAPSULE = 'Capsule';
    const LOCATION_FLAG_CARGO = 'Cargo';
    const LOCATION_FLAG_CORPDELIVERIES = 'CorpDeliveries';
    const LOCATION_FLAG_CORPSAG1 = 'CorpSAG1';
    const LOCATION_FLAG_CORPSAG2 = 'CorpSAG2';
    const LOCATION_FLAG_CORPSAG3 = 'CorpSAG3';
    const LOCATION_FLAG_CORPSAG4 = 'CorpSAG4';
    const LOCATION_FLAG_CORPSAG5 = 'CorpSAG5';
    const LOCATION_FLAG_CORPSAG6 = 'CorpSAG6';
    const LOCATION_FLAG_CORPSAG7 = 'CorpSAG7';
    const LOCATION_FLAG_CRATELOOT = 'CrateLoot';
    const LOCATION_FLAG_DELIVERIES = 'Deliveries';
    const LOCATION_FLAG_DRONEBAY = 'DroneBay';
    const LOCATION_FLAG_DUSTBATTLE = 'DustBattle';
    const LOCATION_FLAG_DUSTDATABANK = 'DustDatabank';
    const LOCATION_FLAG_FIGHTERBAY = 'FighterBay';
    const LOCATION_FLAG_FIGHTERTUBE0 = 'FighterTube0';
    const LOCATION_FLAG_FIGHTERTUBE1 = 'FighterTube1';
    const LOCATION_FLAG_FIGHTERTUBE2 = 'FighterTube2';
    const LOCATION_FLAG_FIGHTERTUBE3 = 'FighterTube3';
    const LOCATION_FLAG_FIGHTERTUBE4 = 'FighterTube4';
    const LOCATION_FLAG_FLEETHANGAR = 'FleetHangar';
    const LOCATION_FLAG_HANGAR = 'Hangar';
    const LOCATION_FLAG_HANGARALL = 'HangarAll';
    const LOCATION_FLAG_HISLOT0 = 'HiSlot0';
    const LOCATION_FLAG_HISLOT1 = 'HiSlot1';
    const LOCATION_FLAG_HISLOT2 = 'HiSlot2';
    const LOCATION_FLAG_HISLOT3 = 'HiSlot3';
    const LOCATION_FLAG_HISLOT4 = 'HiSlot4';
    const LOCATION_FLAG_HISLOT5 = 'HiSlot5';
    const LOCATION_FLAG_HISLOT6 = 'HiSlot6';
    const LOCATION_FLAG_HISLOT7 = 'HiSlot7';
    const LOCATION_FLAG_HIDDENMODIFIERS = 'HiddenModifiers';
    const LOCATION_FLAG_IMPLANT = 'Implant';
    const LOCATION_FLAG_IMPOUNDED = 'Impounded';
    const LOCATION_FLAG_JUNKYARDREPROCESSED = 'JunkyardReprocessed';
    const LOCATION_FLAG_JUNKYARDTRASHED = 'JunkyardTrashed';
    const LOCATION_FLAG_LOSLOT0 = 'LoSlot0';
    const LOCATION_FLAG_LOSLOT1 = 'LoSlot1';
    const LOCATION_FLAG_LOSLOT2 = 'LoSlot2';
    const LOCATION_FLAG_LOSLOT3 = 'LoSlot3';
    const LOCATION_FLAG_LOSLOT4 = 'LoSlot4';
    const LOCATION_FLAG_LOSLOT5 = 'LoSlot5';
    const LOCATION_FLAG_LOSLOT6 = 'LoSlot6';
    const LOCATION_FLAG_LOSLOT7 = 'LoSlot7';
    const LOCATION_FLAG_LOCKED = 'Locked';
    const LOCATION_FLAG_MEDSLOT0 = 'MedSlot0';
    const LOCATION_FLAG_MEDSLOT1 = 'MedSlot1';
    const LOCATION_FLAG_MEDSLOT2 = 'MedSlot2';
    const LOCATION_FLAG_MEDSLOT3 = 'MedSlot3';
    const LOCATION_FLAG_MEDSLOT4 = 'MedSlot4';
    const LOCATION_FLAG_MEDSLOT5 = 'MedSlot5';
    const LOCATION_FLAG_MEDSLOT6 = 'MedSlot6';
    const LOCATION_FLAG_MEDSLOT7 = 'MedSlot7';
    const LOCATION_FLAG_OFFICEFOLDER = 'OfficeFolder';
    const LOCATION_FLAG_PILOT = 'Pilot';
    const LOCATION_FLAG_PLANETSURFACE = 'PlanetSurface';
    const LOCATION_FLAG_QUAFEBAY = 'QuafeBay';
    const LOCATION_FLAG_REWARD = 'Reward';
    const LOCATION_FLAG_RIGSLOT0 = 'RigSlot0';
    const LOCATION_FLAG_RIGSLOT1 = 'RigSlot1';
    const LOCATION_FLAG_RIGSLOT2 = 'RigSlot2';
    const LOCATION_FLAG_RIGSLOT3 = 'RigSlot3';
    const LOCATION_FLAG_RIGSLOT4 = 'RigSlot4';
    const LOCATION_FLAG_RIGSLOT5 = 'RigSlot5';
    const LOCATION_FLAG_RIGSLOT6 = 'RigSlot6';
    const LOCATION_FLAG_RIGSLOT7 = 'RigSlot7';
    const LOCATION_FLAG_SECONDARYSTORAGE = 'SecondaryStorage';
    const LOCATION_FLAG_SERVICESLOT0 = 'ServiceSlot0';
    const LOCATION_FLAG_SERVICESLOT1 = 'ServiceSlot1';
    const LOCATION_FLAG_SERVICESLOT2 = 'ServiceSlot2';
    const LOCATION_FLAG_SERVICESLOT3 = 'ServiceSlot3';
    const LOCATION_FLAG_SERVICESLOT4 = 'ServiceSlot4';
    const LOCATION_FLAG_SERVICESLOT5 = 'ServiceSlot5';
    const LOCATION_FLAG_SERVICESLOT6 = 'ServiceSlot6';
    const LOCATION_FLAG_SERVICESLOT7 = 'ServiceSlot7';
    const LOCATION_FLAG_SHIPHANGAR = 'ShipHangar';
    const LOCATION_FLAG_SHIPOFFLINE = 'ShipOffline';
    const LOCATION_FLAG_SKILL = 'Skill';
    const LOCATION_FLAG_SKILLINTRAINING = 'SkillInTraining';
    const LOCATION_FLAG_SPECIALIZEDAMMOHOLD = 'SpecializedAmmoHold';
    const LOCATION_FLAG_SPECIALIZEDCOMMANDCENTERHOLD = 'SpecializedCommandCenterHold';
    const LOCATION_FLAG_SPECIALIZEDFUELBAY = 'SpecializedFuelBay';
    const LOCATION_FLAG_SPECIALIZEDGASHOLD = 'SpecializedGasHold';
    const LOCATION_FLAG_SPECIALIZEDINDUSTRIALSHIPHOLD = 'SpecializedIndustrialShipHold';
    const LOCATION_FLAG_SPECIALIZEDLARGESHIPHOLD = 'SpecializedLargeShipHold';
    const LOCATION_FLAG_SPECIALIZEDMATERIALBAY = 'SpecializedMaterialBay';
    const LOCATION_FLAG_SPECIALIZEDMEDIUMSHIPHOLD = 'SpecializedMediumShipHold';
    const LOCATION_FLAG_SPECIALIZEDMINERALHOLD = 'SpecializedMineralHold';
    const LOCATION_FLAG_SPECIALIZEDOREHOLD = 'SpecializedOreHold';
    const LOCATION_FLAG_SPECIALIZEDPLANETARYCOMMODITIESHOLD = 'SpecializedPlanetaryCommoditiesHold';
    const LOCATION_FLAG_SPECIALIZEDSALVAGEHOLD = 'SpecializedSalvageHold';
    const LOCATION_FLAG_SPECIALIZEDSHIPHOLD = 'SpecializedShipHold';
    const LOCATION_FLAG_SPECIALIZEDSMALLSHIPHOLD = 'SpecializedSmallShipHold';
    const LOCATION_FLAG_STRUCTUREACTIVE = 'StructureActive';
    const LOCATION_FLAG_STRUCTUREFUEL = 'StructureFuel';
    const LOCATION_FLAG_STRUCTUREINACTIVE = 'StructureInactive';
    const LOCATION_FLAG_STRUCTUREOFFLINE = 'StructureOffline';
    const LOCATION_FLAG_SUBSYSTEMBAY = 'SubSystemBay';
    const LOCATION_FLAG_SUBSYSTEMSLOT0 = 'SubSystemSlot0';
    const LOCATION_FLAG_SUBSYSTEMSLOT1 = 'SubSystemSlot1';
    const LOCATION_FLAG_SUBSYSTEMSLOT2 = 'SubSystemSlot2';
    const LOCATION_FLAG_SUBSYSTEMSLOT3 = 'SubSystemSlot3';
    const LOCATION_FLAG_SUBSYSTEMSLOT4 = 'SubSystemSlot4';
    const LOCATION_FLAG_SUBSYSTEMSLOT5 = 'SubSystemSlot5';
    const LOCATION_FLAG_SUBSYSTEMSLOT6 = 'SubSystemSlot6';
    const LOCATION_FLAG_SUBSYSTEMSLOT7 = 'SubSystemSlot7';
    const LOCATION_FLAG_UNLOCKED = 'Unlocked';
    const LOCATION_FLAG_WALLET = 'Wallet';
    const LOCATION_FLAG_WARDROBE = 'Wardrobe';
}
