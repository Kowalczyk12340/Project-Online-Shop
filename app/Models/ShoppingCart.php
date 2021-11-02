<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShoppingCart extends Model 
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id'];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withTimestamps()->withPivot('quantity','sell_price');
    }

    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function statusCart()
    {
        return $this->belongsTo('App\Models\StatusCart');
    }
}