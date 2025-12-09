<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            "first_name"        => "Student",
            "last_name"         => "First",
            "email"             => "student@biopharmainfo.net",
            'password'          => bcrypt('password'),
            "phone"             => "1",
            "gender"            => "male",
            "school_id"         => "12",
            "status"            => "1",
            "created_by"        => "1",
        ]);
    }
}
