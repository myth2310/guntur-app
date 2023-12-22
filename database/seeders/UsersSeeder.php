<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $faker->addProvider(new \Faker\Provider\id_ID\Person($faker));

        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name(),
                'description' => $faker->sentence(),
                'lat' => $faker->latitude(),
                'longi' => $faker->longitude(),
                'email' => $faker->unique()->safeEmail(),
                'img_url' => $faker->imageUrl(),
                'password' => bcrypt('password'), // Anda mungkin ingin menghasilkan kata sandi yang unik
            ]);
        }
    }
}
