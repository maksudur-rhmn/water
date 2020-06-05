<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class ShopController extends Controller
{
   public function index ()
   {
     return view('frontend.shop', [
       'categories' => Category::all(),
       'products'  => Product::all(),
     ]);

   }
}
