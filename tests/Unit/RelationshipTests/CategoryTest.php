<?php

namespace Tests\Unit\RelationshipTests;

use Tests\ModelTestCase;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryTest extends ModelTestCase
{
    public function test_products_relation()
    {
        $m = new Category();
        $r = $m->products();
        $this->assertHasManyRelation($r, $m, new Product());
    }

        public function test_displaying_category()
    {
        $categories = Category::all();
        $category = $categories->first();
        $this->assertNotEquals(null, $category);
    }

    public function test_displaying_correct_name_for_category()
    {
        $categories = Category::all();
        $category = $categories->first()->category_name;
        $this->assertEquals('Akcesoria Letnie', $category);
    }
}