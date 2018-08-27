<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Product;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'mobile', 'address','email', 'password', 'roles', 'stripe_id', 'card_brand', 'card_last_four', 'trial_ends_at'
    ];

    public function cart()
    {
        return $this->belongsToMany('App\Product', 'product_user', 'user_id', 'product_id')->withTimestamps();
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
