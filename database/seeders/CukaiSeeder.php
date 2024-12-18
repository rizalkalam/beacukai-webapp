<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CukaiSeeder extends Seeder
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
                'file' => 'file_cukai/tes123.pdf',
                'regulation_id' => 1
            ],

            [
                'id' => 2,
                'title' => 'tes123.pdf',
                'file' => 'file_cukai/tes123.pdf',
                'regulation_id' => 2
            ],

            [
                'id' => 3,
                'title' => 'tes123.pdf',
                'file' => 'file_cukai/testestes.pdf',
                'regulation_id' => 3
            ],

            [
                'id' => 4,
                'title' => 'tes123.pdf',
                'file' => 'file_cukai/cobates.pdf',
                'regulation_id' => 4
            ],

            [
                'id' => 5,
                'title' => 'tes123.pdf',
                'file' => 'file_cukai/cobates.pdf',
                'regulation_id' => 5
            ],
        ];

        DB::table('cukais')->insert($data);
    }
}
