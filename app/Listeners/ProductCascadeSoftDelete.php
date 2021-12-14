<?php

namespace App\Listeners;

use App\Events\CategoryDeleted;
use Illuminate\Support\Facades\Log;

class ProductCascadeSoftDelete
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CategoryDeleted  $event
     * @return void
     */
    public function handle(CategoryDeleted $event)
    {
        Log::debug('Zdarzenie usuwania kategorii ' . $event->category->name);
    }
}
