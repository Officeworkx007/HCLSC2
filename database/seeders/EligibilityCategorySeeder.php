<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EligibilityCategorySeeder extends Seeder
{
      public function run(): void
    {
        $data = [
            ['name' => 'Women'],
            ['name' => 'Children'],
            ['name' => 'Persons with disability'],
            ['name' => 'Industrial Workmen'],
            ['name' => 'Victims of mass disaster, violence, flood, drought, earthquake or industrial disaster'],
            ['name' => 'Victims of Trafficking in human beings or beggar'],
            ['name' => 'Persons in Custody in a protective home or in a juvenile home or in a psychiatric hospital or nursing home'],
            ['name' => 'General (Persons whose annual income does not exceed prescribed limit'],
            ['name' => 'Transgender'],
            ['name' => 'Defence Personnel (Serving)'],
            ['name' => 'Defence Personnel (Retired)'],
            ['name' => 'Defence Personnel (Dependent)'],
            ['name' => 'Scheduled Caste'],
            ['name' => 'Scheduled Tribe'],
            ['name' => 'Others'],
        ];

        DB::table('eligibility_category')->insert($data);
    }
}
