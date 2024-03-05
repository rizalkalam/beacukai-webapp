<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KepabeananRegulationSeeder extends Seeder
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
        ];

        DB::table('kepabeanan_regulations')->insert($data);
    }
}
