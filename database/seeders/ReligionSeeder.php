<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligionSeeder extends Seeder
{

    public function run(): void
    {
        $data = [
            ['name' => 'Hindu'],
            ['name' => 'Christian'],
            ['name' => 'Jain'],
            ['name' => 'Muslim'],
            ['name' => 'Sikh'],
            ['name' => 'Others'],
        ];

        DB::table('religions')->insert($data);
    }
}
