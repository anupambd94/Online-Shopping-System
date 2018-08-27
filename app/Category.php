<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category'
    ];

    public function product()
    {
        return $this->belongsToMany('App\Product', 'category_product', 'category_id', 'product_id')->withTimestamps();
    }
}
