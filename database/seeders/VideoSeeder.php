<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Video::create([
            'id' => 1,
            'title' => 'INOVASI BEA CUKAI KUDUS DUKUNG EKSPOR | PODKESKU EPISODE 3 | PODCAST BEA CUKAI KUDUS',
            'link' => 'https://youtu.be/uy0CSo1AeuM?si=3gUSSaZynIOh3OaL'
        ]);

        Video::create([
            'id' => 2,
            'title' => 'BELI PITA CUKAI | PODKESKU EPISODE 2 | PODCAST BEA CUKAI KUDUS',
            'link' => 'https://youtu.be/Lql3OrotWo0?si=Eh-Cks5VOcvWq9S7'
        ]);

        Video::create([
            'id' => 3,
            'title' => 'INOVASI BEA CUKAI KUDUS DUKUNG EKSPOR | PODKESKU EPISODE 3 | PODCAST BEA CUKAI KUDUS',
            'link' => 'https://youtu.be/uy0CSo1AeuM?si=3gUSSaZynIOh3OaL'
        ]);

        Video::create([
            'id' => 4,
            'title' => 'BELI PITA CUKAI | PODKESKU EPISODE 2 | PODCAST BEA CUKAI KUDUS',
            'link' => 'https://youtu.be/Lql3OrotWo0?si=Eh-Cks5VOcvWq9S7'
        ]);

        Video::create([
            'id' => 5,
            'title' => 'INOVASI BEA CUKAI KUDUS DUKUNG EKSPOR | PODKESKU EPISODE 3 | PODCAST BEA CUKAI KUDUS',
            'link' => 'https://youtu.be/uy0CSo1AeuM?si=3gUSSaZynIOh3OaL'
        ]);

        Video::create([
            'id' => 6,
            'title' => 'BELI PITA CUKAI | PODKESKU EPISODE 2 | PODCAST BEA CUKAI KUDUS',
            'link' => 'https://youtu.be/Lql3OrotWo0?si=Eh-Cks5VOcvWq9S7'
        ]);
    }
}
