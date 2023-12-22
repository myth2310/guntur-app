<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fasilitas;
use App\Models\User;
use Faker\Factory as Faker;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Fasilitas::create([
                'id_user' => User::inRandomOrder()->first()->id_user,
                'lat' => $faker->latitude(),
                'longi' => $faker->longitude(),
                'type' => $faker->randomElement(['TypeA', 'TypeB', 'TypeC']),
            ]);
        }
    }
}
