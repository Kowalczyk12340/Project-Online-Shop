<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;
use Tests\WithStubUser;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoriesTest extends TestCase
{
    use DatabaseTransactions, WithStubUser;

    public function test_index_authentication()
    {
        $this->assertNotTrue('/categories');
        $this->assertNotTrue('/categories/create');
        $this->assertNotTrue('/categories', 'store');
        $this->assertNotTrue('/categories/1');
        $this->assertNotTrue('/categories/edit/1');
        $this->assertNotTrue('/categories/delete/1');
    }

    public function test_index_view()
    {
        $user = $this->createStubUser();
        $response = $this->actingAs($user)->get('/categories');

        $response->assertStatus(302);
        $response->assertRedirectContains('login');
    }

    public function test_authenticated_user_can_create_new_category()
    {
        $this->actingAs($this->createStubUser());

        $this->get('/categories/create')
             ->assertStatus(302);
    }

    public function test_it_checks_for_invalid_category()
    {
        $this->actingAs($this->createStubUser());

        $this->postJson('/categories', ['name' => ''])
             ->assertStatus(405);
    }

    public function test_authenticated_user_can_view_a_category()
    {
        $category = $this->createCategory();

        $this->get("/categories/{$category->id}")
             ->assertStatus(302);
    }

    public function test_not_authenticated_user_can_not_edit_an_existing_category()
    {
        $category = $this->createCategory();

        $this->get("/categories/{$category->id}/edit")
             ->assertStatus(404);
    }

    public function test_not_authenticated_user_can_not_delete_an_existing_category()
    {
        $category = $this->createCategory();

        $this->delete("/categories/{$category->id}")
             ->assertStatus(405);
    }

    private function createCategory($authenticated = true)
    {
        $category = new Category();

        if ($authenticated) {
            $this->actingAs($this->createStubUser());
        }

        return $category;
    }
}