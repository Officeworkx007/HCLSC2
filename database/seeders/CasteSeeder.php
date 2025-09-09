<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CasteSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Scheduled Caste'],
            ['name' => 'Scheduled Tribe'],
            ['name' => 'General'],
            ['name' => 'OBC'],
        ];

        DB::table('castes')->insert($data);
    }
}
