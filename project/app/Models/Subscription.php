<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['title','currency','currency_code','price','days','allowed_products', 'allowed_deals','details'];

    public $timestamps = false;
    
    public function subs()
    {
        return $this->hasMany('App\Models\UserSubscription','subscription_id');
    }

}