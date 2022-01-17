<?php

namespace Tests\Unit\Events;

use App\Models\Category;
use App\Events\CategoryShown;
use Tests\SimpleTestCase;

class CategoryShownTest extends SimpleTestCase
{
    public function test_event_constructor()
    {
        $category = new Category([
            'id' => 99,
            'name' => 'Botki'
        ]);

        $e = new CategoryShown($category);

        $this->assertSame($category, $e->category);
    }
}