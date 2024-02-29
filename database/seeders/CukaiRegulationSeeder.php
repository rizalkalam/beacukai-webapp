<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CukaiRegulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'regulation_name' => 'Pemesanan Pita Cukai'
            ],

            [
                'id' => 2,
                'regulation_name' => 'Perizinan'
            ],

            [
                'id' => 3,
                'regulation_name' => 'Tarif Cukai'
            ],

            [
                'id' => 4,
                'regulation_name' => 'Pelunasan Cukai'
            ],

            [
                'id' => 5,
                'regulation_name' => 'Penundaan dan Pembayaran Berkala'
            ],
        ];

        DB::table('cukai_regulations')->insert($data);
    }
}
