<?php

namespace App\Http\Controllers;

use Auth;
use Stripe;
use App\Cart;
use App\Order;
use Carbon\Carbon;
use App\Order_list;
use Illuminate\Http\Request;

class StripePaymentController extends Controller
{
     /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $request->total * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);

        $order = Order::create([

            'user_id'          => Auth::id(),
            'full_name'        => $request->full_name,
            'email'            => $request->email,
            'phone_number'     => $request->phone_number,
            'country_id'       => $request->country_id,
            'city_id'          => $request->city_id,
            'address'          => $request->address,
            'notes'            => $request->notes,
            'total'            => $request->total,
            'sub_total'        => $request->sub_total,
            'coupon_name'      => $request->coupon_name,
            'payment_method'   => 2,
            'created_at'       => Carbon::now(),

        ]);
            
        foreach(cartItems() as $item)
        {
            Order_list::insert([
                'order_id'   => $order->id,
                'user_id'    => Auth::id(),
                'product_id' => $item->product_id,
                'amount'     => $item->cart_amount,
                'created_at' => Carbon::now(),
            ]);

         Cart::find($item->id)->delete();

        }
          
        return redirect('/');
  }
}
 