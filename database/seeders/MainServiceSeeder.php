<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Layanan NPPBKC',
                'title' => 'Regisrasi NPPBKC HPTL',
                'service_description' => 'Registrasi Nomor Pokok Pengusaha Barang Kena Cukai (NPPBKC) Baru diperuntukkan bagi Pengusaha BKC yang belum pernah mendapatkan NPPBKC sebelumnya. Tata Cara Pemberian, Pembekuan, dan Pencabutan NPPBKC diatur dalam Peraturan Menteri Keuangan Nomor 66/PMK.04/2018 yang dapat diunduh di sini. Peraturan ini mulai berlaku per tanggal 01 Oktober 2018.',
                'title_service_image_1' => 'Persyaratan lokasi',
                'service_image_1' => '',
                'title_service_image_2' => 'Alur registrasi NPPBKC baru',
                'service_image_2' => '',
                'title_service_flow' => 'Alur registrasi NPPBKC baru',
                'description_of_service_flow' => '',
            ],
        ];

        DB::table('kepabeanans')->insert($data);
    }
}
