<?php 

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusCartsSeeder extends Seeder 
{
    /**
     * Run the database seeds
     * 
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $statuses = [
            1 => 'opłacony',
            2 => 'nieopłacony',
        ];

        foreach($statuses as $key => $status)
        {
            DB::table('status_carts')->insert([
                'id' => $key,
                'status_name' => $status,
                'created_at' => $faker->dateTimeBetween(
                    '-20 days',
                    '-10 days'
                ),
                'updated_at' => rand(0, 9) < 5
                    ? null 
                    : $faker->dateTimeBetween(
                        '-10 days',
                        '-5 days'
                    ),
                'deleted_at' => null
            ]);
        }
    }
}