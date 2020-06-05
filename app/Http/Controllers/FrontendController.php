<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Faq;
use App\Order_list;
use App\Product;
use DB;

class FrontendController extends Controller
{
  function index ()
  {
    $categories = Category::all();
    $products = Product::all();
    $bestseller = Order_list::with('getproduct')
                            ->select('product_id', DB::raw('count(*) as total'))
                            ->groupBy('product_id')
                            ->orderBy('total', 'desc')
                            ->take(4)
                            ->get();
                            
    return view('frontend/index', compact('categories', 'products', 'bestseller'));
  }

  function about ()
  {
    return view('frontend.about');
  }

  function front_faq()
  {
    $faqs = Faq::all();
    return view('frontend.faq', compact('faqs'));
  }

  // END
}
