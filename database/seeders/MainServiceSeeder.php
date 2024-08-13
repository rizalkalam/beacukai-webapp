<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
                'service_image_1' => 'service_image/img1.png',
                'title_service_image_2' => 'Alur registrasi NPPBKC baru',
                'service_image_2' => 'service_image/img2.png',
                'title_service_flow' => 'Alur registrasi NPPBKC baru',
                'description_of_service_flow' => 'test',
                'title_supporting_image_1' => 'test',
                'supporting_image_1' => 'service_image/img3.png',
                'description_of_supporting_1' => 'test',
                'title_supporting_image_2' => 'test',
                'supporting_image_2' => 'service_image/img4.png',
                'description_of_supporting_2' => 'test',
            ],
            [
                'id' => 2,
                'name' => 'Layanan Test',
                'title' => 'Regisrasi NPPBKC HPTL',
                'service_description' => 'Registrasi Nomor Pokok Pengusaha Barang Kena Cukai (NPPBKC) Baru diperuntukkan bagi Pengusaha BKC yang belum pernah mendapatkan NPPBKC sebelumnya. Tata Cara Pemberian, Pembekuan, dan Pencabutan NPPBKC diatur dalam Peraturan Menteri Keuangan Nomor 66/PMK.04/2018 yang dapat diunduh di sini. Peraturan ini mulai berlaku per tanggal 01 Oktober 2018.',
                'title_service_image_1' => 'Persyaratan lokasi',
                'service_image_1' => 'service_image/img1.png',
                'title_service_image_2' => 'Alur registrasi NPPBKC baru',
                'service_image_2' => 'service_image/img2.png',
                'title_service_flow' => 'Alur registrasi NPPBKC baru',
                'description_of_service_flow' => 'test',
                'title_supporting_image_1' => 'test',
                'supporting_image_1' => 'service_image/img3.png',
                'description_of_supporting_1' => 'test',
                'title_supporting_image_2' => 'test',
                'supporting_image_2' => 'service_image/img4.png',
                'description_of_supporting_2' => 'test',
            ],
            [
                'id' => 3,
                'name' => 'Layanan HPTL',
                'title' => 'test',
                'service_description' => 'Registrasi Nomor Pokok Pengusaha Barang Kena Cukai (NPPBKC) Baru diperuntukkan bagi Pengusaha BKC yang belum pernah mendapatkan NPPBKC sebelumnya. Tata Cara Pemberian, Pembekuan, dan Pencabutan NPPBKC diatur dalam Peraturan Menteri Keuangan Nomor 66/PMK.04/2018 yang dapat diunduh di sini. Peraturan ini mulai berlaku per tanggal 01 Oktober 2018.',
                'title_service_image_1' => 'Persyaratan lokasi',
                'service_image_1' => 'service_image/img1.png',
                'title_service_image_2' => 'Alur registrasi NPPBKC baru',
                'service_image_2' => 'service_image/img2.png',
                'title_service_flow' => 'Alur registrasi NPPBKC baru',
                'description_of_service_flow' => 'test',
                'title_supporting_image_1' => 'test',
                'supporting_image_1' => 'service_image/img3.png',
                'description_of_supporting_1' => 'test',
                'title_supporting_image_2' => 'test',
                'supporting_image_2' => 'service_image/img4.png',
                'description_of_supporting_2' => 'test',
            ],
        ];

        DB::table('main_services')->insert($data);
    }
}
