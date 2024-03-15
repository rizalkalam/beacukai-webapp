<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CukaiSeeder;
use Database\Seeders\PhotoSeeder;
use Database\Seeders\VideoSeeder;
use Database\Seeders\BannerSeeder;
use Database\Seeders\RevenueSeeder;
use Database\Seeders\KepabeananSeeder;
use Database\Seeders\AchievementSeeder;
use Database\Seeders\CertificateSeeder;
use Database\Seeders\SopCategorySeeder;
use Database\Seeders\CukaiRegulationSeeder;
use Database\Seeders\KepabeananRegulationSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            BannerSeeder::class,
            VideoSeeder::class,
            PhotoSeeder::class,
            RevenueSeeder::class,
            CukaiSeeder::class,
            CukaiRegulationSeeder::class,
            KepabeananSeeder::class,
            KepabeananRegulationSeeder::class,
            SopCategorySeeder::class,
            AchievementSeeder::class,
            CertificateSeeder::class,
        ]);
    }
}
