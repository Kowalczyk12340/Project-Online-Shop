<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShoppingCartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $shoppingcarts = [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9,
            10,
            11,
            12
        ];

        foreach ($shoppingcarts as $key => $cart) {
            DB::table('shopping_carts')->insert([
                'id' => $key+1,
                'user_id' => rand(1,5),
                'status_cart_id' => rand(1,2),
                'submission_date' => $faker->dateTimeBetween('now'),
                'implementation_date' => $faker->dateTimeBetween('now', '+07 days'),
                'total_price' => rand(100,999),
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
                'deleted_at' => null,
            ]);
        }
    }
}
