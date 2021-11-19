<?php

namespace App\Console;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\ProductShoppingCart;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $shopping_carts = ShoppingCart::where('status_cart_id', 2)->get();
            foreach($shopping_carts as $cart)
            {
                $array[] = $cart->id;
            }
            if(isset($array)) {
                $shoppingCartProducts = ProductShoppingCart::whereIn('shopping_cart_id', $array)->get();
                for($i = 0; $i < count($shoppingCartProducts); $i++){
                    $pro = Product::where('id', $shoppingCartProducts[$i]->product_id)->first();
                    $p = Product::where('id', $shoppingCartProducts[$i]->product_id)->update(['stock_status' => ($pro->stock_status+$shoppingCartProducts[$i]->quantity)]);
                    $shoppingCartProducts[$i]->delete();
                }
                $shopping_carts = ShoppingCart::where('status_cart_id', 2)->update(['total_price' => 0]);
            }
        })->everyMinute();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}