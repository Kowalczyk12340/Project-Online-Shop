<?php

namespace App\Events;

use App\Models\Category;
use Illuminate\Queue\SerializesModels;

class CategoryShown
{
    use SerializesModels;

    /**
     * @var \App\Models\Category
     */
    public $category;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
}