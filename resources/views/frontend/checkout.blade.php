@extends('layouts.frontend')

@section('title')
  Water - Checkout
@endsection
@section('content')
       <!-- .breadcumb-area start -->
       <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Checkout</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Checkout</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- checkout-area start -->
    <div class="checkout-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if($errors->all())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    <div class="checkout-form form-style">
                        <h3>Billing Details</h3>
                            <form id="paypal_sub" action="{{ route('order.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <p>Full Name</p>
                                        <input type="text" name="full_name" value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Email Address *</p>
                                        <input type="email" name="email" value="{{ Auth::user()->email }}">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Phone No. *</p>
                                        <input type="text" name="phone_number" placeholder="Areacode : (+123) Number : (123-456)">
                                    </div>
                                    <div class="col-12">
                                        <select name="country_id" id="country_id">
                                            <option value="">--Select Your Country</option>
                                            @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <select name="city_id" id="city_list">
                                            <option value="">--Select Your City</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <p>Your Address *</p>
                                        <input type="text" name="address">
                                    </div>
                                    <div class="col-12">
                                        <p>Order Notes </p>
                                        <textarea name="notes" placeholder="Notes about Your Order, e.g.Special Note for Delivery" name="notes"></textarea>
                                    </div>
                                </div>
                           
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="order-area">
                            <h3>Your Order</h3>
                            <ul class="total-cost">
                                @foreach (cartItems() as $item)
                                <li>{{ $item->get_product->product_name }} Qt. {{ $item->cart_amount }} <span class="pull-right">${{ $item->get_product->product_price * $item->cart_amount }}</span></li>
                                @endforeach
                                <li>Subtotal <span class="pull-right"><strong>${{ cartTotal() }}</strong></span></li>
                                <li>Coupon <span class="pull-right">{{ $coupon_name ?? "No coupon used" }}</span></li>
                                <li>Total<span class="pull-right">${{ $total ?? cartTotal() }}</span></li>
                            </ul>
                            <ul class="payment-method">
                                <li>
                                    <input value="3" id="paypal" type="radio" name="payment_method">
                                    <label for="paypal">Paypal</label>
                                </li>
                                <li>
                                    <input value="2" id="card" type="radio" name="payment_method">
                                    <label for="card">Credit Card</label>
                                </li>
                                <li>
                                    <input value="1" id="delivery" type="radio" name="payment_method" checked>
                                    <label for="delivery">Cash on Delivery</label>
                                </li>
                            </ul>
                            <input name="sub_total" type="hidden" value="{{ cartTotal() }}">
                            <input name="coupon_name" type="hidden" value="{{ $coupon_name }}">
                            <input name="total" type="hidden" value="{{ $total ?? cartTotal() }}">
                            <button type="submit">Place Order</button>
                            </form>
                            <div class="btn"></div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- checkout-area end -->

@endsection

@section('script')

 
    <script>
        $(document).ready(function(){
           $("#country_id").change(function(){
           var country_id = $('#country_id').val();
         
            // Ajax Default Code Start 

            $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });        

            // Ajax Default Code Ends 

            $.ajax({
               type:'POST',
               url:'/citylist',
               data:{country_id:country_id},
               success:function(data)
               {
                 $("#city_list").html(data);
               }
           });
            
           });
        });
    </script>
     
  <script>
    $(document).ready(function(){
        $("#paypal").click(function(){
            var form = document.getElementById('paypal_sub')
            form.action = "{{ route('create-payment') }}"
            console.log(form)
        })
        $("#delivery").unbind("click", process_click);
        $("#card").unbind("click", process_click);
    })

</script>

@endsection