<?php

namespace App\Http\Controllers;

use Auth;
use App\Cart;
use App\City;
use App\Order;
use App\Country;
use Carbon\Carbon;
use App\Order_list;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
  
        $coupon_name = $request->coupon_name;
        $total = $request->total;
        $countries = Country::all();
        $cities = City::all();
        return view('frontend.checkout', compact('coupon_name', 'total', 'countries', 'cities'));
    }

    
    public function order(Request $request)
    {
        $request->validate([
            'phone_number' =>'required',
        ]);
        if($request->payment_method == 1)
        {
            $order = Order::create($request->except('_token') + ['user_id' => Auth::id(), 'created_at' => Carbon::now()]);
            
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
        elseif($request->payment_method == 2)
        {

            return view('stripe',[

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
            ]);
        }
 
    }




    public function getcitylist(Request $request)
    {
        $cities = City::where('country_id', $request->country_id)->get();
        
        $dropdown = "";
        foreach($cities as $city)
        {
         $dropdown .= "<option value='".$city->id ."'>". $city->name ."</option>";
       
        }
        echo $dropdown;


    }


}
