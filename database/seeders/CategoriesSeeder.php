<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $categories = [
            1 => 'Akcesoria Letnie',
            2 => 'Akcesoria Zimowe',
            3 => 'Piłki Sportowe',
            4 => 'Dresy Sportowe',
            5 => 'Buty Sportowe',
            6 => 'Suplementy',
        ];

        foreach($categories as $key => $category) {
            DB::table('categories')->insert([
                'id' => $key,
                'category_name' => $category,
                'image' => 'storage',
                'created_at' => $faker->dateTimeBetween(
                    '-20 days',
                    '-10 days'
                ),
                'updated_at' => rand(0,9) < 5
                    ? null 
                    : $faker->dateTimeBetween(
                        '-10 days',
                        '-5 days'
                    ),
                'deleted_at' => null,
            ]);
        }
    }
}