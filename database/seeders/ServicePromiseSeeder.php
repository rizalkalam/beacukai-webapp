<?php

namespace Database\Seeders;

use App\Models\ServicePromise;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServicePromiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServicePromise::create([
            'id' => 1,
            'name' => 'Perizinan Tempat Penimbunan Berikat (TPB), Penyelenggara Kawasan Berikat (PKB), Penyelenggara Dalam Kawasan Berikat (PDKB).',
            'time' => '3 Hari',
            'cost' => 'Tidak Dipungut Biaya'
        ]);

        ServicePromise::create([
            'id' => 2,
            'name' => 'Penyelesaian perizinan pengeluaran sementara (dalam rangka subkontrak/perbaikan Barang Modal) ke Tempat Lain Dalam Daerah Pabean (TLDPP).',
            'time' => '1 Hari',
            'cost' => 'Tidak Dipungut Biaya'
        ]);

        ServicePromise::create([
            'id' => 3,
            'name' => 'Perizinan Perusakan Barang Hasil Produksi Kawasan Berikat',
            'time' => '1 Hari',
            'cost' => 'Tidak Dipungut Biaya'
        ]);

        ServicePromise::create([
            'id' => 4,
            'name' => 'Penyelesaian permohonan BC 2.5 jalur kuning dan merah',
            'time' => '1 Hari',
            'cost' => 'Tidak Dipungut Biaya'
        ]);

        ServicePromise::create([
            'id' => 5,
            'name' => 'Perizinan Tempat Penimbunan Berikat (TPB), Penyelenggara Kawasan Berikat (PKB), Penyelenggara Dalam Kawasan Berikat (PDKB)',
            'time' => '1 Hari',
            'cost' => 'Tidak Dipungut Biaya'
        ]);
    }
}
