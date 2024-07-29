<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\FaqSeeder;
use Illuminate\Database\Seeder;
use App\Models\UserSatisfaction;
use Database\Seeders\UserSeeder;
use Database\Seeders\CukaiSeeder;
use Database\Seeders\PhotoSeeder;
use Database\Seeders\VideoSeeder;
use Database\Seeders\BannerSeeder;
use Database\Seeders\RevenueSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\KepabeananSeeder;
use Database\Seeders\AchievementSeeder;
use Database\Seeders\CertificateSeeder;
use Database\Seeders\ServiceUserSeeder;
use Database\Seeders\SopCategorySeeder;
use Database\Seeders\WorkingAreaSeeder;
use Database\Seeders\ServicePromiseSeeder;
use Database\Seeders\CukaiRegulationSeeder;
use Database\Seeders\KepabeananRegulationSeeder;
use Database\Seeders\OrganizationalStructureSeeder;

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
            FaqSeeder::class,
            WorkingAreaSeeder::class,
            UserSatisfactionSeeder::class,
            ServiceSeeder::class,
            ServicePromiseSeeder::class,
            OrganizationalStructureSeeder::class,
        ]);
    }
}
