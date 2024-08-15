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
                'sub_title_1' => 'Test',
                'image_1' => 'service_image/img1.png',
                'information_1' => 'Layanan Google yang ditawarkan tanpa biaya ini dapat langsung menerjemahkan berbagai kata, frasa, dan halaman web ke bahasa Indonesia dan lebih dari 100 ... DeepL Translate: Penerjemah paling akurat di seluruh dunia DeepL Translate https://www.deepl.com › translator Terjemahkan teks & berkas dokumen secara instan. Terjemahan yang akurat untuk individu dan tim. Jutaan orang menerjemahkan dengan DeepL setiap hari.',
                'sub_title_2' => 'Test2',
                'image_2' => 'service_image/img2.png',
                'information_2' => 'Layanan Google yang ditawarkan tanpa biaya ini dapat langsung menerjemahkan berbagai kata, frasa, dan halaman web ke bahasa Indonesia dan lebih dari 100 ... DeepL Translate: Penerjemah paling akurat di seluruh dunia DeepL Translate https://www.deepl.com › translator Terjemahkan teks & berkas dokumen secara instan. Terjemahan yang akurat untuk individu dan tim. Jutaan orang menerjemahkan dengan DeepL setiap hari.',
                'sub_title_3' => 'Test3',
                'image_3' => 'service_image/img3.png',
                'information_3' => 'Layanan Google yang ditawarkan tanpa biaya ini dapat langsung menerjemahkan berbagai kata, frasa, dan halaman web ke bahasa Indonesia dan lebih dari 100 ... DeepL Translate: Penerjemah paling akurat di seluruh dunia DeepL Translate https://www.deepl.com › translator Terjemahkan teks & berkas dokumen secara instan. Terjemahan yang akurat untuk individu dan tim. Jutaan orang menerjemahkan dengan DeepL setiap hari.',
                'sub_title_4' => 'Test4',
                'image_4' => 'service_image/img4.png',
                'information_4' => 'Layanan Google yang ditawarkan tanpa biaya ini dapat langsung menerjemahkan berbagai kata, frasa, dan halaman web ke bahasa Indonesia dan lebih dari 100 ... DeepL Translate: Penerjemah paling akurat di seluruh dunia DeepL Translate https://www.deepl.com › translator Terjemahkan teks & berkas dokumen secara instan. Terjemahan yang akurat untuk individu dan tim. Jutaan orang menerjemahkan dengan DeepL setiap hari.',
                'sub_title_5' => 'Test5',
                'image_5' => null,
                'information_5' => 'Layanan Google yang ditawarkan tanpa biaya ini dapat langsung menerjemahkan berbagai kata, frasa, dan halaman web ke bahasa Indonesia dan lebih dari 100 ... DeepL Translate: Penerjemah paling akurat di seluruh dunia DeepL Translate https://www.deepl.com › translator Terjemahkan teks & berkas dokumen secara instan. Terjemahan yang akurat untuk individu dan tim. Jutaan orang menerjemahkan dengan DeepL setiap hari.',
            ],
            [
                'id' => 2,
                'name' => 'Layanan Test',
                'sub_title_1' => null,
                'image_1' => null,
                'information_1' => null,
                'sub_title_2' => null,
                'image_2' => null,
                'information_2' => null,
                'sub_title_3' => null,
                'image_3' => null,
                'information_3' => null,
                'sub_title_4' => null,
                'image_4' => null,
                'information_4' => null,
                'sub_title_5' => null,
                'image_5' => null,
                'information_5' => null,
            ],
            [
                'id' => 3,
                'name' => 'Layanan HPTL',
                'sub_title_1' => null,
                'image_1' => null,
                'information_1' => null,
                'sub_title_2' => null,
                'image_2' => null,
                'information_2' => null,
                'sub_title_3' => null,
                'image_3' => null,
                'information_3' => null,
                'sub_title_4' => null,
                'image_4' => null,
                'information_4' => null,
                'sub_title_5' => null,
                'image_5' => null,
                'information_5' => null,
            ],
        ];

        DB::table('main_services')->insert($data);
    }
}
