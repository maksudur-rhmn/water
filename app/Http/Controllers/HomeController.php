<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Charts\SevenDaysSale;
use App\Charts\PaymentMethodChart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {

        for ($i=1; $i <= 7 ; $i++) { 

           $date[] =  Carbon::now()->subDays(7-$i)->format('Y-m-d');
           $orders[] =  Order::whereDate('created_at',Carbon::now()->subDays(7-$i)->format('Y-m-d'))->sum('total');
        }

        

        //  $todays_order = Order::whereDate('created_at', Carbon::now()->format('Y-m-d'))->sum('total');



          // Chart Starts 

          $SevenDaysSaleChart = new SevenDaysSale;
          $SevenDaysSaleChart->labels($date);
          $SevenDaysSaleChart->dataset('Seven Days sale', 'bar', $orders)->options([

            'backgroundColor' => [

                'red',
                '#5B93D3',
                '#2B333E',
                'green',
                'blue',
                'yellow',
                'orange',

            ],


          ]);

          // Chart ends

          // Second Chart Starts
          

          $cod = Order::where('payment_method', 1)->count();
          $card = Order::where('payment_method', 2)->count();
          $paypal = Order::where('payment_method', 3)->count();


          $payment_method = new PaymentMethodChart;
          $payment_method->labels(['Cash on Delivery', 'Card Payment', 'PayPal']);
          $payment_method->dataset('Payment Methods', 'pie', [$cod, $card, $paypal])->options([

            'backgroundColor' => [

                '#5B93D3',
                '#2B333E',
                'blue',

            ],


          ]);

          
          // Second Chart Ends 


        

          $logged = Auth::id();
          $total_user = User::count();
          // $users = User::where('id', "!=", $logged)->get();
          $users = User::all()->except(Auth::id());
          return view('home', compact('users', 'total_user', 'SevenDaysSaleChart', 'payment_method'));
    }
}
