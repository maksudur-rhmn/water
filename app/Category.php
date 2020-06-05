<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $guarded = [];


    public function relationBetweenCategory()
    {
      return $this->hasOne('App\User', 'id', 'added_by');
    }

    public function get_product()
    {
      return $this->hasMany('App\Product');
    }
}
