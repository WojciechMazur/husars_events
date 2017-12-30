<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatusCode extends Model
{
    protected $table='ref_order_status_codes';

    public function orders(){
         return $this->belongsToMany('App\Order');
    }

}
