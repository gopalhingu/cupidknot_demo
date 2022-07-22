<?php

namespace Database\Seeders;

use App\Models\PreFamilyTypes;
use Illuminate\Database\Seeder;
use App\Models\PreOccupation;
use App\Models\PrePartners;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
    $faker = \Faker\Factory::create();
        for ($i = 0; $i < 50; $i++) {
            $user = User::create([
                'first_name' => $faker->name(),
                'last_name' => $faker->name(),
                'email' => $faker->safeEmail,
                'password' => Hash::make($faker->password(8)),
                'gender' => $faker->randomElement(["male", "female"]),
                'dob' => $faker->date,
                'income' => rand(0, 500),
                'occupation' => $faker->randomElement([1, 2, 3]),
                'family_type' => $faker->randomElement([1, 2]),
                'manglik' => $faker->randomElement(["yes", "no"]),
            ]);

            $randomIncome = rand(0, 50) . '-' . rand(250, 500);
            $preferredIncome = explode('-', $randomIncome);

            $partner = PrePartners::create([
                'user_id' => $user->id,
                'pre_income_from' => $preferredIncome[0],
                'pre_income_to' => $preferredIncome[1],
                'pre_manglik' => $faker->randomElement(["yes", "no","both"]),
            ]);

            $preferredOccupation = $faker->randomElement($array = [[1, 2, 3]], rand(1, 2));
            foreach ($preferredOccupation as $occupation) {
                PreOccupation::upsert([
                    ['partner_id' => $partner->id, 'occupation_id' => $occupation],
                ], ['partner_id', 'occupation_id']);
            }

            $preferredFamily = $faker->randomElement($array = [[1, 2]], rand(1, 1));
            foreach ($preferredFamily as $type) {
                PreFamilyTypes::upsert([
                    ['partner_id' => $partner->id, 'family_type_id' => $type],
                ], ['partner_id', 'occupation_id']);
            }
        }


    }
}
