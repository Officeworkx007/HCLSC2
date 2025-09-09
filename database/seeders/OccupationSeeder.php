<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OccupationSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Business Person'],
            ['name' => 'Daily Wager'],
            ['name' => 'Doctor'],
            ['name' => 'Engineer'],
            ['name' => 'Farmer'],
            ['name' => 'Govt. Employee'],
            ['name' => 'Housewife'],
            ['name' => 'Industrial Worker'],
            ['name' => 'Labour Work'],
            ['name' => 'Military Person'],
            ['name' => 'Public Sector Employee'],
            ['name' => 'Private Sector Employee'],
            ['name' => 'Self Employed'],
            ['name' => 'Student'],
            ['name' => 'Teacher'],
            ['name' => 'Others'],
        ];

        DB::table('occupations')->insert($data);
    }
}
