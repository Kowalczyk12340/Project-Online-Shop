<?php 

use App\Models\Offer;
use App\Models\Product;
use App\Models\Order;
use Tests\TestCase;
use App\Models\User;

class OrderControllerTest extends TestCase
{
    public function test_it_redirects_to_details_order_if_user_is_not_authenticated()
    {
        $response = $this->call('GET', 'orders/details/1');

        // Just check that you don't get a 404 NotFound response.
        $this->assertTrue($response->isNotFound());
    }

    public function test_it_redirects_to_details_orders_if_user_is_not_authenticated()
    {
        $response = $this->call('GET', 'orders');
        // Just check that you don't get a 401 Unauhtorized response.
        $this->assertFalse($response->isOk());
    }
}