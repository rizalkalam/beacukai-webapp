<?php

namespace Database\Seeders;

use App\Models\Certificate;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Certificate::create([
            'id' => 1,
            'file' => 'certificates/sertifikat1.jpg'
        ]);

        Certificate::create([
            'id' => 2,
            'file' => 'certificates/sertifikat2.jpg'
        ]);

        Certificate::create([
            'id' => 3,
            'file' => 'certificates/sertifikat3.jpg'
        ]);

        Certificate::create([
            'id' => 4,
            'file' => 'certificates/sertifikat4.jpg'
        ]);

        Certificate::create([
            'id' => 5,
            'file' => 'certificates/sertifikat5.jpg'
        ]);

        Certificate::create([
            'id' => 6,
            'file' => 'certificates/sertifikat6.jpg'
        ]);

        Certificate::create([
            'id' => 7,
            'file' => 'certificates/sertifikat7.jpg'
        ]);
    }
}
