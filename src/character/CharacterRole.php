<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 01.10.18
 * Time: 12:13
 */

namespace DenisKhodakovskiyESI\src\character;

class CharacterRole
{
    const ROLE_ACCOUNT_TAKE_1 = 'Account_Take_1';
    const ROLE_ACCOUNT_TAKE_2 = 'Account_Take_2';
    const ROLE_ACCOUNT_TAKE_3 = 'Account_Take_3';
    const ROLE_ACCOUNT_TAKE_4 = 'Account_Take_4';
    const ROLE_ACCOUNT_TAKE_5 = 'Account_Take_5';
    const ROLE_ACCOUNT_TAKE_6 = 'Account_Take_6';
    const ROLE_ACCOUNT_TAKE_7 = 'Account_Take_7';
    const ROLE_ACCOUNTANT = 'Accountant';
    const ROLE_AUDITOR = 'Auditor';
    const ROLE_COMMUNICATIONS_OFFICER = 'Communications_Officer';
    const ROLE_CONFIG_EQUIPMENT = 'Config_Equipment';
    const ROLE_CONFIG_STARBASE_EQUIPMENT = 'Config_Starbase_Equipment';
    const ROLE_CONTAINER_TAKE_1 = 'Container_Take_1';
    const ROLE_CONTAINER_TAKE_2 = 'Container_Take_2';
    const ROLE_CONTAINER_TAKE_3 = 'Container_Take_3';
    const ROLE_CONTAINER_TAKE_4 = 'Container_Take_4';
    const ROLE_CONTAINER_TAKE_5 = 'Container_Take_5';
    const ROLE_CONTAINER_TAKE_6 = 'Container_Take_6';
    const ROLE_CONTAINER_TAKE_7 = 'Container_Take_7';
    const ROLE_CONTRACT_MANAGER = 'Contract_Manager';
    const ROLE_DIPLOMAT = 'Diplomat';
    const ROLE_DIRECTOR = 'Director';
    const ROLE_FACTORY_MANAGER = 'Factory_Manager';
    const ROLE_FITTING_MANAGER = 'Fitting_Manager';
    const ROLE_HANGAR_QUERY_1 = 'Hangar_Query_1';
    const ROLE_HANGAR_QUERY_2 = 'Hangar_Query_2';
    const ROLE_HANGAR_QUERY_3 = 'Hangar_Query_3';
    const ROLE_HANGAR_QUERY_4 = 'Hangar_Query_4';
    const ROLE_HANGAR_QUERY_5 = 'Hangar_Query_5';
    const ROLE_HANGAR_QUERY_6 = 'Hangar_Query_6';
    const ROLE_HANGAR_QUERY_7 = 'Hangar_Query_7';
    const ROLE_HANGAR_TAKE_1 = 'Hangar_Take_1';
    const ROLE_HANGAR_TAKE_2 = 'Hangar_Take_2';
    const ROLE_HANGAR_TAKE_3 = 'Hangar_Take_3';
    const ROLE_HANGAR_TAKE_4 = 'Hangar_Take_4';
    const ROLE_HANGAR_TAKE_5 = 'Hangar_Take_5';
    const ROLE_HANGAR_TAKE_6 = 'Hangar_Take_6';
    const ROLE_HANGAR_TAKE_7 = 'Hangar_Take_7';
    const ROLE_JUNIOR_ACCOUNTANT = 'Junior_Accountant';
    const ROLE_PERSONNEL_MANAGER = 'Personnel_Manager';
    const ROLE_RENT_FACTORY_FACILITY = 'Rent_Factory_Facility';
    const ROLE_RENT_OFFICE = 'Rent_Office';
    const ROLE_RENT_RESEARCH_FACILITY = 'Rent_Research_Facility';
    const ROLE_SECURITY_OFFICER = 'Security_Officer';
    const ROLE_STARBASE_DEFENSE_OPERATOR = 'Starbase_Defense_Operator';
    const ROLE_STARBASE_FUEL_TECHNICIAN = 'Starbase_Fuel_Technician';
    const ROLE_STATION_MANAGER = 'Station_Manager';
    const ROLE_TERRESTRIAL_COMBAT_OFFICER = 'Terrestrial_Combat_Officer';
    const ROLE_TERRESTRIAL_LOGISTICS_OFFICER = 'Terrestrial_Logistics_Officer';
    const ROLE_TRADER = 'Trader';

    /**
     * @var string
     */
    public $title;

    public function __construct($title)
    {
        $this->title = $title;
    }
}
