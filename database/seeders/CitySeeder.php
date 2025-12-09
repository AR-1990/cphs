<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            "id"                => 1,
            "name"              => "Karachi",
            "country_id"        => 1,
            "status"            => 1,
            "created_by"        => 1
        ]);

        City::create([
            "id"                => 2,
            "name"              => "Lahore",
            "country_id"        => 1,
            "status"            => 1,
            "created_by"        => 1
        ]);
    }
}
