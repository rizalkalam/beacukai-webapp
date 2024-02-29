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
                'name' => 'PMK No. 66/PMK.04/2018 tentang Tata Cara Pemberian, Pembekuan',
                'file' => 'file/tes123.pdf',
                'regulation_id' => 1
            ],

            [
                'id' => 2,
                'name' => 'Surat Edaran Dirjen Bea dan Cukai No. SE-07/BC/2009',
                'file' => 'file/tes123.pdf',
                'regulation_id' => 1
            ],
        ];

        DB::table('cukais')->insert($data);
    }
}
