<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Photo::create([
            'id' => 1,
            'file' => 'photos/poto1.jpg'
        ]);

        Photo::create([
            'id' => 2,
            'file' => 'photos/poto2.jpg'
        ]);

        Photo::create([
            'id' => 3,
            'file' => 'photos/poto3.jpg'
        ]);

        Photo::create([
            'id' => 4,
            'file' => 'photos/poto4.jpg'
        ]);

        Photo::create([
            'id' => 5,
            'file' => 'photos/poto5.jpg'
        ]);

        Photo::create([
            'id' => 6,
            'file' => 'photos/poto6.jpg'
        ]);

        Photo::create([
            'id' => 7,
            'file' => 'photos/poto7.jpg'
        ]);

        Photo::create([
            'id' => 8,
            'file' => 'photos/poto8.jpg'
        ]);

        Photo::create([
            'id' => 9,
            'file' => 'photos/poto9.jpg'
        ]);
    }
}
