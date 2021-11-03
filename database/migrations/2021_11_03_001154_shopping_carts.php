<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShoppingCarts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->date('submission_date')->nullable();
            $table->date('implementation_date')->nullable();
            $table->decimal('total_price',8,2)->default(0);
            $table->unsignedInteger('status_cart_id')->default(2);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_cart_id')->references('id')->on('status_carts');
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
        Schema::dropIfExists('shopping_carts');
    }
}
