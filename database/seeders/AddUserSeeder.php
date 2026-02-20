<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
        // [
        //     "fullname"   => "Syed",
        //     "email"      => "syed@bicphs.com",
        //     "phone"      => "-",
        //     "address"    => "-",
        //     "age"        => "0",
        //     "gender"     => "male",
        //     "id_card_no" => "-",
        //     'password'   => bcrypt('password'),
        //     "status"     => 1,
        //     "created_by" => 1,
        //     "updated_by" => 1,
        // ],
        [
            "fullname"   => "Nayab",
            "email"      => "nayab@bicphs.com",
            "phone"      => "-",
            "address"    => "-",
            "age"        => "0",
            "gender"     => "female",
            "id_card_no" => "-",
            'password'   => bcrypt('password'),
            "status"     => 1,
            "created_by" => 1,
            "updated_by" => 1,
        ]);
    }
}
