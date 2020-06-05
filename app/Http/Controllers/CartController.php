<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($coupon_name = "")
    {
       if(cartTotal() > 0)
       {
        if($coupon_name != "")
        {
          if(Coupon::where('coupon_name', $coupon_name)->exists())
          {
           if(Coupon::where('coupon_name', $coupon_name)->first()->valid_till >= Carbon::now()->format('Y-m-d'))
           {
             $coupon_name;
             $coupon_discount = Coupon::where('coupon_name', $coupon_name)->first();
             return view('frontend.cart', compact('coupon_name', 'coupon_discount'));
           }
           else 
           {
            return redirect('/cart')->withErrors('Coupon is Expired');
           }
          }
          else 
          {
           return redirect('/cart')->withErrors('Coupon is invalid');
          }
        }
        else
        {
          return view('frontend.cart');
        }
       }
       else 
       {
         return redirect('/')->withSuccess('You do not have any products on cart');
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // echo $request->ip();
      if(Cart::where('ip_address', $request->ip())->where('product_id', $request->product_id)->exists())
      {
        Cart::where('ip_address', $request->ip())->where('product_id', $request->product_id)->increment('cart_amount', $request->cart_amount);
        return back()->withSuccess('Product Updated to Cart');
      }
      else
      {
        Cart::insert([
          'ip_address'  => $request->ip(),
          'cart_amount' => $request->cart_amount,
          'product_id'  => $request->product_id,
          'created_at'  => Carbon::now(),
        ]);
        return back()->withSuccess('Product Added to Cart');
      }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function delete($cart_id)
    {
      Cart::find($cart_id)->delete();
      return back()->withSuccess('Product Removed From the Cart');
    }

    public function cartUpdate(Request $request)
    {

      foreach ($request->id as $key => $id) {
        Cart::findOrFail($id)->update([
          'cart_amount' => $request->cart_amount[$key],
        ]);
      }
        return back()->withSuccess('Cart Updated');
    }



















    // END
}
