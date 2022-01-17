<?php

namespace Tests\Unit\RelationshipTests;

use App\Models\ShoppingCart;
use App\Models\Product;
use App\Models\Supplier;
use Tests\ModelTestCase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShoppingCartTest extends ModelTestCase
{
    public function test_products_relation()
    {
        $m = new ShoppingCart();
        $r = $m->product();
        $this->assertHasManyRelation($r, $m, new Product());
    }
}