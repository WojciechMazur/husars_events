<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Product;

class Image extends Model
{
    public function products(){
        return $this->belongsTo('Product', 'product_image');
    }
}
