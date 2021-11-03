<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder 
{
    /**
     * Run the database seeds
     * 
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $products = [
            1 => 'Nordic Walking Nike',
            2 => 'Bluza Adidas',
            3 => 'Narty Fisher',
            4 => 'Kask Slatnar',
            5 => 'Tango 12 Adidas',
            6 => 'Vels34 Puma',
            7 => 'Dres Reebook',
            8 => 'Dres Nike',
            9 => 'Hypervenom Nike',
            10 => 'F10 Adidas',
            11 => 'Białko Cargo',
            12 => 'Isotonic Energix',
        ];

        foreach ($products as $key => $product) {
            DB::table('products')->insert([
                'id' => $key,
                'name' => $product,
                'category_id' => rand(1,6),
                'unit_price' => rand(100,999),
                'stock_status' => rand(0,150),
                'description' => Str::random(20),
                'image' =>'storage',
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