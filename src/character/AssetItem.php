<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 29.09.18
 * Time: 22:25
 */

namespace DenisKhodakovskiyESI\src\character;

use DenisKhodakovskiyESI\src\BaseObject;

class AssetItem extends BaseObject
{
    const LOCATION_FLAG_ASSETSAFETY = 'AssetSafety';
    const LOCATION_FLAG_AUTOFIT = 'AutoFit';
    const LOCATION_FLAG_BOOSTERBAY = 'BoosterBay';
    const LOCATION_FLAG_CARGO = 'Cargo';
    const LOCATION_FLAG_CORPSEBAY = 'CorpseBay';
    const LOCATION_FLAG_DELIVERIES = 'Deliveries';
    const LOCATION_FLAG_DRONEBAY = 'DroneBay';
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
    const LOCATION_FLAG_QUAFEBAY = 'QuafeBay';
    const LOCATION_FLAG_RIGSLOT0 = 'RigSlot0';
    const LOCATION_FLAG_RIGSLOT1 = 'RigSlot1';
    const LOCATION_FLAG_RIGSLOT2 = 'RigSlot2';
    const LOCATION_FLAG_RIGSLOT3 = 'RigSlot3';
    const LOCATION_FLAG_RIGSLOT4 = 'RigSlot4';
    const LOCATION_FLAG_RIGSLOT5 = 'RigSlot5';
    const LOCATION_FLAG_RIGSLOT6 = 'RigSlot6';
    const LOCATION_FLAG_RIGSLOT7 = 'RigSlot7';
    const LOCATION_FLAG_SHIPHANGAR = 'ShipHangar';
    const LOCATION_FLAG_SKILL = 'Skill';
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
    const LOCATION_FLAG_WARDROBE = 'Wardrobe';

    const LOCATION_TYPE_STATION = 'station';
    const LOCATION_TYPE_SOLAR_SYSTEM = 'solar_system';
    const LOCATION_TYPE_OTHER = 'other';

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
}
