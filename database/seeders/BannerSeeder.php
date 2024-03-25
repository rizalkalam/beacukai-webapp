<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::create([
            'id' => 1,
            'file' => 'banners/banner1.jpg'
        ]);

        Banner::create([
            'id' => 2,
            'file' => 'banners/banner2.jpg'
        ]);

        Banner::create([
            'id' => 3,
            'file' => 'banners/banner3.jpg'
        ]);
    }
}
