<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductShoppingCartsSeeder extends Seeder
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
            DB::table('product_shopping_carts')->insert([
                'id' => $key+1,
                'product_id' => rand(1,12),
                'quantity' => rand(2,5),
                'shopping_cart_id' => $key+1,
                'sell_price' => rand(100,999),
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
            ]);
        }
    }
}