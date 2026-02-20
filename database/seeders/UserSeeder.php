<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "fullname"   => "Dr. Naqvi",
            "email"      => "dr.naqvi@biopharmainfo.net",
            "phone"      => "-",
            "address"    => "-",
            "age"        => "50",
            "gender"     => "male",
            "id_card_no" => "-",
            'password'   => bcrypt('password'),
            "status"     => 1,
            "role" => 1,
            "created_by" => 1,
            "updated_by" => 1,
        ]);
    }
}
