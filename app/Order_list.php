<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_list extends Model
{
    protected $guarded = [];

    function getproduct()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
