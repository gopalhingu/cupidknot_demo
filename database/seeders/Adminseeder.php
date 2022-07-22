<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        User::create([
            'type' => 1,
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'gopal@gmail.com',
            'password' => Hash::make('admin'),
            'gender' => 'male',
            'dob' => $faker->date,
            'income' => rand(1, 500),
            'occupation' => $faker->randomElement([1, 2, 3]),
            'family_type' => $faker->randomElement([1, 2]),
            'manglik' => $faker->randomElement(["yes", "no"]),
        ]);
    }
}
