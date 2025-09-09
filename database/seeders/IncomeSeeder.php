<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomeSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Nil'],
            ['name' => 'Below Permissible Limit'],
            ['name' => 'Above Permissible Limit'],
            ['name' => 'Unknown'],
        ];

        DB::table('incomes')->insert($data);
    }
}
