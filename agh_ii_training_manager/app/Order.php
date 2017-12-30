<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Customer');
    }

    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }

    public function status()
    {
        return $this->hasOne('App\OrderStatusCode', 'id', 'status_code');
    }
}
