<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Achievement::create([
            'id' => 1,
            'title' => 'Piagam Penghargaan Kementerian PAN-RB atas Kantor Berpredikat sebagai Unit Kerja yang Berkategori Wilayah Birokrasi Bersih Melayani (WBBM)',
            'date' => '2024-2-10'
        ]);

        Achievement::create([
            'id' => 2,
            'title' => 'Satker Terbaik Penilaian Kinerja Pelaksanaan Anggaran Triwulan III 2020 Kategori Pagu Anggaran 5-20 Miliar',
            'date' => '2024-3-2'
        ]);

        Achievement::create([
            'id' => 3,
            'title' => 'Satker Terbaik Penilaian Kinerja Pelaksanaan Anggaran Triwulan III 2020 Kategori Pagu Anggaran 5-20 Miliar',
            'date' => '2024-3-3'
        ]);
    }
}
