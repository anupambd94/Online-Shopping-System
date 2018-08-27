<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Category;
use App\Subcategory;
use App\Cart;
use App\User;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'price', 'pricediscount', 'quantity', 'category', 'subcategory','imageextension',
    ];

    public function category()
    {
        return $this->belongsToMany('App\Category', 'category_product', 'product_id', 'category_id')->withTimestamps();
    }

    public function subcategory()
    {
        return $this->belongsToMany('App\Subcategory', 'subcategory_product', 'product_id', 'subcategory_id')->withTimestamps();
    }
}
