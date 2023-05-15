<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        foreach( range(1, 30) as $value ){
            DB::table('companies')->insert([
                'name'    => $faker->company(),
                'email'   => $faker->unique()->companyEmail(),
                'logo'    => $faker->image(storage_path('app/public/image'), 100, 100, 'nature', false),
                'website' => $faker->url(),
            ]);
        }
    }
}
