<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CategoriesSeeder;
use Database\Seeders\ProductsSeeder;
use Database\Seeders\ProductShoppingCartsSeeder;
use Database\Seeders\ShoppingCartsSeeder;
use Database\Seeders\StatusCartSeeder;
use Database\Seeders\Auth\RolesSeeder;
use Database\Seeders\Auth\UsersSeeder;
use Database\Seeders\Auth\PermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(StatusCartsSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(ShoppingCartsSeeder::class);
        $this->call(ProductShoppingCartsSeeder::class);
    }
}
