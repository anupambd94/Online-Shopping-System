<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Subcategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subcategory', 'category'
    ];

    public function product()
    {
        return $this->belongsToMany('App\Product', 'subcategory_product', 'subcategory_id', 'product_id')->withTimestamps();
    }
}
