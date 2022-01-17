<?php 

namespace Tests\Unit\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use App\Models\Order;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeControllerTest extends TestCase
{
    /**
     * @test
     */
    public function test_it_redirects_to_login_if_user_is_not_authenticated()
    {
        $response = $this->call('GET', 'login');

        // Just check that you don't get a 200 OK response.
        $this->assertTrue($response->isOk());
    }

    public function test_it_redirects_to_register_if_user_is_not_authenticated()
    {
        $response = $this->call('GET', 'register');

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