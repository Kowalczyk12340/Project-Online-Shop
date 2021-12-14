<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductShoppingCarts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_shopping_cart', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('shopping_cart_id');
            $table->unsignedBigInteger('product_id');
            $table->decimal('quantity',8,2);
            $table->decimal('sell_price',8,2);
            $table->foreign('shopping_cart_id')->references('id')->on('shopping_carts');
            $table->foreign('product_id')->references('id')->on('products');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_shopping_cart');
    }
}
