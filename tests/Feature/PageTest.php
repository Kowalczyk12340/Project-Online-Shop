<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_home_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_get_login()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_get_register()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_get_shoppingCarts_orders()
    {
        $response = $this->get('/shoppingCarts/orders');

        $response->assertStatus(302);
    }

    public function test_get_oneProduct_details()
    {
        $response = $this->get('/products/details/3');

        $response->assertStatus(200);
    }

    public function test_get_one_product_with_chosen_category()
    {
        $response = $this->get('/products/all/Dresy%20Sportowe');

        $response->assertStatus(200);
    }
}