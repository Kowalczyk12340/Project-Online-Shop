<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model 
{
    use HasFactory;
    use SoftDeletes;

    public function shopping_cart()
    {
        return $this->belongsToMany('App\Models\ShoppingCart');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}