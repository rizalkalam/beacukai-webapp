<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_faqCategory = [
            [
                'id' => 1,
                'name' => 'Cukai'
            ],

            [
                'id' => 2,
                'name' => 'NPPBKC'
            ],

            [
                'id' => 3,
                'name' => 'Penetapan Tarif Cukai'
            ],

            [
                'id' => 4,
                'name' => 'Pita Cukai'
            ],
        ];

        $data_faqContent =[
            [
                'id' => 1,
                'title' => 'Apakah yang dimaksud dengan Barang Kena Cukai (BKC) ?',
                'description' => 'Barang kena cukai adalah barang-barang tertentu yang mempunyai sifat atau karakteristik yang ditetapkan dalam Undang-Undang Cukai',
                'category_id' => 1,
            ],

            [
                'id' => 2,
                'title' => 'Apakah Cukai itu?',
                'description' => 'Barang yang 1. konsumsinya perlu dikendalikan 2. peredarannya perlu diawasi 3. pemakaiannya dapat menimbulkan efek negatif bagi masyarakat atau lingkungan hidup 4. atau pemakaiannya perlu pembebanan pungutan negara demi keadilan dan keseimbangan',
                'category_id' => 1,
            ],

            [
                'id' => 3,
                'title' => 'Apakah sajakah Barang Kena Cukai (BKC) itu ?',
                'description' => 'Menurut Undang-Undang Nomor 39 Tahun 2007, BKC terdiri dari : 1. etil alkohol (EA) atau etanol 2. minuman yang mengandung etil alkohol (MMEA) 3. hasil tembakau',
                'category_id' => 1,
            ],

            [
                'id' => 4,
                'title' => 'Adakah Undang-Undang yang mengatur tentang cukai ?',
                'description' => 'Undang-undang Republik Indonesia Nomor 11 Tahun 1995 tentang Cukai sebagai mana telah diubah dengan Undang-undang Republik Indonesia Nomor 39 Tahun 2007 tentang Perubahan atas Undang-undang Republik Indonesia Nomor 11 Tahun 1995 tentang Cukai',
                'category_id' => 1,
            ],

            [
                'id' => 5,
                'title' => 'tes',
                'description' => 'tes123',
                'category_id' => 2,
            ],

            [
                'id' => 6,
                'title' => 'tes',
                'description' => 'tes123',
                'category_id' => 3,
            ],

            [
                'id' => 7,
                'title' => 'tes',
                'description' => 'tes123',
                'category_id' => 4,
            ],
        ];

        DB::table('faq_categories')->insert($data_faqCategory);
        DB::table('faq_contents')->insert($data_faqContent);
    }
}
