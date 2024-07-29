<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrganizationalStructure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrganizationalStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrganizationalStructure::create([
            'id' => 1,
            'image' => 'organizational_structure/struktur.png'
        ]);
    }
}
