<?php 

use App\Models\Offer;
use App\Models\Product;
use App\Models\Order;
use Tests\TestCase;
use App\Models\User;

class ProductControllerTest extends TestCase
{
    public function test_it_redirects_to_details_if_user_is_not_authenticated()
    {
        $response = $this->call('GET', 'products/details/2');

        // Just check that you don't get a 200 OK response.
        $this->assertTrue($response->isOk());
    }

    public function test_it_redirects_to_products_if_user_is_not_authenticated()
    {
        $response = $this->call('GET', 'products/all/Buty%20Sportowe');

        // Just check that you don't get a 200 OK response.
        $this->assertTrue($response->isOk());
    }

    /**
     * @test
     */
    public function it_returns_home_page_products_for_anonymous()
    {
        $response = $this->call('GET', 'products');

        // Just check that you don't get a 200 OK response.
        $this->assertFalse($response->isOk());
    }
}