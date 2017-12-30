<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'type_code', 'description', 'long-description'];
    public function images(){
        return $this->belongsToMany('App\Image', 'product_image');
    }

}
