<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UploadDocumentSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Aadhar Card'],
            ['name' => 'Caste Certificate'],
            ['name' => 'Ration Card'],
            ['name' => 'Voter ID Card'],
            ['name' => 'Others'],
        ];

        DB::table('upload_documents')->insert($data);
    }
}
