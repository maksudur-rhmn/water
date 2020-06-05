<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $guarded = [];

   public function relationBetweenCategory()
   {
     return $this->belongsTo('App\Category', 'category_id', 'id');
   }

   public function get_multiple_image()
   {
     return $this->hasMany('App\ProductMultipleImage');
   }

}
