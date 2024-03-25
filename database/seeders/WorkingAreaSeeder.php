<?php

namespace Database\Seeders;

use App\Models\WorkingArea;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorkingAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkingArea::create([
            'id' => 1,
            'tobacco' => 90,
            'tpe_mmea_ea' => 13,
            'bonded_storage_place' => 14
        ]);
    }
}
