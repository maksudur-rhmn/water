@extends('layouts.frontend')

@section('title')
  Water - Cart
@endsection

@section('content')
  <!-- .breadcumb-area start -->
   <div class="breadcumb-area bg-img-4 ptb-100">
       <div class="container">
           <div class="row">
               <div class="col-12">
                   <div class="breadcumb-wrap text-center">
                       <h2>Shopping Cart</h2>
                       <ul>
                           <li><a href="index.html">Home</a></li>
                           <li><span>Shopping Cart</span></li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!-- .breadcumb-area end -->
   <!-- cart-area start -->
   <div class="cart-area ptb-100">
       <div class="container">
           <div class="row">
               <div class="col-12">
                   <form action="{{ route('cart.custom.update') }}" method="post">
                     @csrf
                       <table class="table-responsive cart-wrap">
                         @if (session('success'))
                           <div class="alert alert-success" role="alert">
                               {{ session('success') }}
                           </div>
                         @endif
                         @if($errors->all())
                             <div class="alert alert-danger">
                                 @foreach ($errors->all() as $error)
                                     <li>{{ $error }}</li>
                                 @endforeach
                             </div>
                         @endif
                           <thead>
                               <tr>
                                   <th class="images">Image</th>
                                   <th class="product">Product</th>
                                   <th class="ptice">Price</th>
                                   <th class="quantity">Quantity</th>
                                   <th class="total">Total</th>
                                   <th class="remove">Remove</th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach (cartItems() as $item)
                                 <tr>
                                     <td class="images"><img src="{{ asset('uploads/product_thumbnail_image') }}/{{ $item->get_product->product_thumbnail_image }}" alt=""></td>
                                     <td class="product"><a href="{{ route('products.show', $item->get_product->product_slug) }}">{{ $item->get_product->product_name }}</a></td>
                                     <td class="ptice">${{ $item->get_product->product_price }}</td>
                                     <input type="hidden" name="id[]" value="{{ $item->id }}">
                                     <td class="quantity cart-plus-minus">
                                         <input name="cart_amount[]" type="text" value="{{ $item->cart_amount }}"/>
                                     </td>
                                     <td class="total">${{ $item->cart_amount * $item->get_product->product_price }}</td>
                                     <td class="remove">
                                       <a href="{{ route('cart.delete', $item->id) }}"><i class="fa fa-times"></i></a>
                                     </td>
                                 </tr>
                               @endforeach
                           </tbody>
                       </table>
                       <div class="row mt-60">
                           <div class="col-xl-4 col-lg-5 col-md-6 ">
                               <div class="cartcupon-wrap">
                                   <ul class="d-flex">
                                       <li>
                                           <button type="submit">Update Cart</button>
                                         </form>
                                       </li>
                                       <li><a href="{{ url('/') }}">Continue Shopping</a></li>
                                   </ul>
                                   <h3>Cupon</h3>
                                   <p>Enter Your Cupon Code if You Have One</p>
                                   <div class="cupon-wrap">
                                       <input type="text" placeholder="Cupon Code" id="couponName" value="{{ $coupon_name ?? "" }}">
                                       <button type="button" id="applyCoupon">Apply Cupon</button>
                                   </div>
                               </div>
                           </div>
                           <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                               <div class="cart-total text-right">
                                   <h3>Cart Totals</h3>
                                   <ul>
                                       <li><span class="pull-left">Subtotal </span>${{ cartTotal() }}</li>
                                       @isset($coupon_discount)
                                       <li><span class="pull-left">Discount </span>{{ $coupon_discount->discount }}%</li>
                                       <li><span class="pull-left">Total </span>${{ $total = cartTotal() - ($coupon_discount->discount / 100) * cartTotal() }}</li>
                                       @else 
                                       <li><span class="pull-left"> Total </span> ${{ cartTotal() }}</li>
                                       @endisset
                                      
                                   </ul>
                                   <form action="{{ route('checkout.index') }}" method="post">
                                    @csrf
                                
                                    <input type="hidden" value="{{ $coupon_discount->coupon_name ?? "" }}" name="coupon_name">
                                    <input type="hidden" value="{{ $total ?? "" }}" name="total">
                             
                                    <button class="btn btn-danger" type="submit">Proceed to Checkout</button>
                                   </form>
                               </div>
                           </div>
                       </div>
               </div>
           </div>
       </div>
   </div>
   <!-- cart-area end -->
@endsection
@section('script')
  <script>
     $(document).ready(function(){
       $('#applyCoupon').click(function(){
          var coupon_name = $('#couponName').val();
          window.location.href = "{{ url('/cart') }}" + "/" + coupon_name
       });
     });
  </script>
@endsection
