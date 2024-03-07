<?php

namespace Database\Seeders;

use App\Models\SopCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SopCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SopCategory::create([
            'id' => 1,
            'name' => 'Subbagian Umum',
            'link' => 'https://www.w3schools.com/'
        ]);

        SopCategory::create([
            'id' => 2,
            'name' => 'Seksi Bendahara',
            'link' => 'https://www.w3schools.com/'
        ]);

        SopCategory::create([
            'id' => 3,
            'name' => 'Seksi Intelejen dan Penindakan',
            'link' => 'https://www.w3schools.com/'
        ]);
    }
}
