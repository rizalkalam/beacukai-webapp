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
                'file' => 'file/tes123.pdf',
                'regulation_id' => 1
            ],

            [
                'id' => 2,
                'file' => 'file/tes123.pdf',
                'regulation_id' => 1
            ],

            [
                'id' => 3,
                'file' => 'file/testestes.pdf',
                'regulation_id' => 2
            ],

            [
                'id' => 4,
                'file' => 'file/cobates.pdf',
                'regulation_id' => 3
            ],
        ];

        DB::table('cukais')->insert($data);
    }
}
