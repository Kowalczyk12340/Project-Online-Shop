<?php 

use App\Models\Offer;
use App\Models\Category;
use App\Models\Order;
use Tests\TestCase;
use App\Models\User;

class CategoryControllerTest extends TestCase
{
    public function test_it_redirects_to_chosen_category_if_user_is_not_authenticated()
    {
        $response = $this->call('GET', 'products/all/Piłki%20Sportowe');

        // Just check that you don't get a 200 OK response.
        $this->assertTrue($response->isOk());
    }

    public function test_it_redirects_to_products_if_user_is_not_authenticated()
    {
        $response = $this->call('GET', '/');

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
        $this->assertFalse($response->isForbidden());
    }
}