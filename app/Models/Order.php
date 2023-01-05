<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id','name','email','card_number','card_exp_month','card_exp_year','plan_name','plan_id','price','price_currency','txn_id','payment_type','payment_status','receipt','user_id'
    ];

    public function appliedCoupon()
    {
        return $this->hasOne('App\Models\UserCoupon', 'order_id', 'order');
    }
}
