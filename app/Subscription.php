<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
 	protected $fillable = ['user_id', 'name', 'stripe_id', 'stripe_plan', 'quantity', 'trial_ends_at', 'ends_at'];
}
