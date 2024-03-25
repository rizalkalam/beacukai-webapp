<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'id' => 1,
            'name' => 'APLIKASI',
            'link' => 'https://laravel.com/docs/10.x/readme',
            'icon' => 'icon-park-twotone:setting-computer'
        ]);

        Service::create([
            'id' => 2,
            'name' => 'CEISA MOBILE',
            'link' => 'https://laravel.com/docs/10.x/readme',
            'icon' => 'icon-park-twotone:setting-computer'
        ]);

        Service::create([
            'id' => 3,
            'name' => 'WARTA BEA CUKAI',
            'link' => 'https://laravel.com/docs/10.x/readme',
            'icon' => 'icon-park-twotone:setting-computer'
        ]);

        Service::create([
            'id' => 4,
            'name' => 'REGISTER EMAI',
            'link' => 'https://laravel.com/docs/10.x/readme',
            'icon' => 'icon-park-twotone:setting-computer'
        ]);

        Service::create([
            'id' => 5,
            'name' => 'CEISA 4.0',
            'link' => 'https://laravel.com/docs/10.x/readme',
            'icon' => 'icon-park-twotone:setting-computer'
        ]);

        Service::create([
            'id' => 6,
            'name' => 'YACHT AND VESSEL DECLARATION',
            'link' => 'https://laravel.com/docs/10.x/readme',
            'icon' => 'icon-park-twotone:setting-computer'
        ]);

        Service::create([
            'id' => 7,
            'name' => 'KANAL BEA CUKAI',
            'link' => 'https://laravel.com/docs/10.x/readme',
            'icon' => 'icon-park-twotone:setting-computer'
        ]);

        Service::create([
            'id' => 8,
            'name' => 'PORTAL PENGGUNA JASA',
            'link' => 'https://laravel.com/docs/10.x/readme',
            'icon' => 'icon-park-twotone:setting-computer'
        ]);

        Service::create([
            'id' => 9,
            'name' => 'TRACKING BARANG KIRIMAN',
            'link' => 'https://laravel.com/docs/10.x/readme',
            'icon' => 'icon-park-twotone:setting-computer'
        ]);
    }
}
