<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use Nexmo;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order_list;
use Spatie\QueryBuilder\QueryBuilder;

class CustomerController extends Controller
{

  function index()
  {

    return view('customer.index', [

      'orders' => Order::where('user_id', Auth::id())->get(),
      
    ]);
  }

  function downloadpdf($order_id)
  {
    $order_info = Order::findOrFail($order_id);
    
    $pdf = PDF::loadView('pdf.invoice', compact('order_info'));
    return $pdf->download('invoice.pdf');
  }

  function sendtext($order_id)
  {
    $order_info = Order::findOrFail($order_id);

    Nexmo::message()->send([

      'to'   => $order_info->phone_number,
      'from' => 'Water',
      'text' => 'Your order number is ' .$order_info->id . 'Your total amount is '. $order_info->total. 'Thank you',
   ]);
      
   return back();

  }

  public function search()
  {
    // $products = QueryBuilder::for(Product::class)
    //                         ->allowedFilters(['product_name', 'category_id'])
    //                         ->get();
    //       return view('frontend.search', compact('products'));

    $product_name = request('product_name');
    $min = request('min');
    $max = request('max');
   
     $products = Product::where('product_name', 'LIKE', '%'.$product_name.'%')
                        ->whereBetween('product_price', [$min, $max])
                        ->orderBy('product_price', 'asc')
                        ->get();

               return view('frontend.search', compact('products'));

  }

  public function addreview(Request $request)
  {
    Order_list::where('product_id', $request->product_id)->where('user_id', Auth::id())->whereNull('review')->update([
      'star'  => $request->stars,
      'review' => $request->review,
    ]);
    return back()->withSuccess('Review added');
  }

// END
}