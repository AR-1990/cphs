<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                   

                   

                    // Area::insert([
                    //     [
                    //         "name"        => "Bahadurabad",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "Clifton",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "Defence Housing Authority (DHA)",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "Gulshan-e-Iqbal",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                     
                    //     [
                    //         "name"        => "Gulistan-e-Jauhar",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "North Nazimabad",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "Korangi",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "Malir",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "Shah Faisal Town",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "Nazimabad",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "Lyari",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "PECHS ",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "Gulzar-e-Hijri",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "Landhi",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "New Karachi",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "Liaquatabad",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "Federal B Area",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "Orangi Town",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "Gulberg",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "North Karachi",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "Surjani Town",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "Baldia Town",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "Karachi Cantonment",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "Gulshan-e-Maymar",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     [
                    //         "name"        => "Clifton Block",
                    //         "city_id"     => 1,
                    //         "status"      => 1,
                    //         "created_by"  => 1
                    //     ],
                    //     // Add more areas as needed
                    // ]);

                    Area::insert([
                        ["name" => "Saddar", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Clifton", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Defence Housing Authority (DHA)", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Gulshan-e-Iqbal", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Gulistan-e-Jauhar", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "PECHS (Pakistan Employees Cooperative Housing Society)", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "North Nazimabad", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Nazimabad", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Karachi Cantt", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Malir", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Korangi", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Landhi", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Shah Faisal Town", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Liaquatabad", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Lyari", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Garden", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Azizabad", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Buffer Zone", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Federal B Area", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Karsaz", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Bahadurabad", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Paposh Nagar", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Gulberg", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Gulshan-e-Maymar", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "North Karachi", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Orangi Town", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "New Karachi", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Keamari", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Gadap Town", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Surjani Town", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Korangi Industrial Area", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Site Town", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Karachi University", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Safoora Goth", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Model Colony", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Shahra-e-Faisal", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Super Highway", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Gulzar-e-Hijri", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Teen Hatti", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Landhi Industrial Area", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Shahrah-e-Quaideen", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Korangi Creek", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "PIB Colony", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Soldier Bazaar", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "PNS Karsaz", "city_id" => 1,"status" => 1, "created_by" => 1],
                        ["name" => "P.E.C.H.S Block 6", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Karachi Port Trust (KPT) Area", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Frere Town", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Sindhi Muslim Society", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Punjab Colony", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Bahria Town Karachi", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Manghopir", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Gulshan-e-Hadeed", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Shadman Town", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Garden East", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Soldier Bazar", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Mehmoodabad", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Qayyumabad", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "PECHS Block 2", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "PECHS Block 3", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "PECHS Block 7", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "PECHS Block 8", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "PECHS Block 9", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "North Karachi - Sector 11-A", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "North Karachi - Sector 5-C", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "North Karachi - Sector 7-D", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "North Karachi - Sector 11-C", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "North Karachi - Sector 5-A", "city_id" => 1, "status" => 1, "created_by" => 1],
                    
                        ["name" => "Shadman Town - Sector-14-B", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Shadman Town - Sector-14-C", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Shadman Town - Sector-14-D", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Shadman Town - Sector-14-A", "city_id" => 1, "status" => 1, "created_by" => 1],
                    
                        ["name" => "Federal B Area - Block 2", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Federal B Area - Block 3", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Federal B Area - Block 4", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Federal B Area - Block 5", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Federal B Area - Block 6", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Orangi Town Sector 11 1/2", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Orangi Town Sector 12", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Orangi Town Sector 13", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Orangi Town Sector 14", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Orangi Town Sector 15", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Orangi Town Sector 16", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "PIB Colony Block 1", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "PIB Colony Block 2", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "PIB Colony Block 3", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "PIB Colony Block 4", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "PIB Colony Block 5", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "PIB Colony Block 6", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "PIB Colony Block 7", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "PIB Colony Block 8", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "PIB Colony Block 9", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "PIB Colony Block 10", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Saddar Bazaar", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Preedy Street", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Bohri Bazaar", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Zainab Market", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Empress Market", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Saddar Parking Plaza", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Regal Chowk", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Plaza Square", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Lucky Star Chowk", "city_id" => 1, "status" => 1, "created_by" => 1],
                        ["name" => "Merewether Tower", "city_id" => 1, "status" => 1, "created_by" => 1],
                    ]);
                    
                }
            }

