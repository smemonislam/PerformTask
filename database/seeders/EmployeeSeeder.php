<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        foreach( range(1, 30) as $value ){
            DB::table('employees')->insert([
                'company_id'    => $faker->numberBetween(1,30),
                'first_name'    => $faker->firstName(),
                'last_name'     => $faker->lastName(),
                'email'         => $faker->unique()->safeEmail(),
                'phone'         => $faker->phoneNumber(),
            ]);
        }
    }
}
