<?php

namespace Tests\Feature;

use App\Models\Product;
use Tests\TestCase;
use Tests\WithStubUser;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    use DatabaseTransactions, WithStubUser;

    public function test_index_authentication()
    {
        $this->assertNotTrue('/product');
        $this->assertNotTrue('/product/create');
        $this->assertNotTrue('/product', 'store');
        $this->assertNotTrue('/product/1');
        $this->assertNotTrue('/product/edit/1');
        $this->assertNotTrue('/product/delete/1');
    }

    public function test_index_view()
    {
        $user = $this->createStubUser();
        $response = $this->actingAs($user)->get('/products');

        $response->assertStatus(302);
        $response->assertRedirectContains('login');
    }

    public function test_authenticated_user_can_create_new_product()
    {
        $this->actingAs($this->createStubUser());

        $this->get('/products/create')
             ->assertStatus(302);
    }

    public function test_it_checks_for_invalid_product()
    {
        $this->actingAs($this->createStubUser());

        $this->postJson('/products', ['name' => ''])
             ->assertStatus(405);
    }

    public function test_authenticated_user_can_view_a_product()
    {
        $product = $this->createProduct();

        $this->get("/products/{$product->id}")
             ->assertStatus(302);
    }

    public function test_not_authenticated_user_can_not_edit_an_existing_product()
    {
        $product = $this->createProduct();

        $this->get("/products/{$product->id}/edit/")
             ->assertStatus(404);
    }

    public function test_not_authenticated_user_can_not_delete_an_existing_product()
    {
        $product = $this->createProduct();

        $this->delete("/products/{$product->id}")
             ->assertStatus(405);
    }

    private function createProduct($authenticated = true)
    {
        $product = new Product();

        if ($authenticated) {
            $this->actingAs($this->createStubUser());
        }

        return $product;
    }
}