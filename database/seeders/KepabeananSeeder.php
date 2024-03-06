<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KepabeananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'title' => 'tes123.pdf',
                'file' => 'file_kepabeanan/tes123.pdf',
                'regulation_id' => 1
            ],
        ];

        DB::table('kepabeanans')->insert($data);
    }
}
