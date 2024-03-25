<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserSatisfaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSatisfactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserSatisfaction::create([
            'date' => '2014-03-02',
            'value' => 4.21,
        ]);

        UserSatisfaction::create([
            'date' => '2015-07-07',
            'value' => 4.1,
        ]);

        UserSatisfaction::create([
            'date' => '2016-05-07',
            'value' => 3.99,
        ]);

        UserSatisfaction::create([
            'date' => '2017-02-07',
            'value' => 4.41,
        ]);

        UserSatisfaction::create([
            'date' => '2018-12-07',
            'value' => 4.41,
        ]);
    }
}
