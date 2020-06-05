<?php

function cartCount()
{
   return App\Cart::where('ip_address', request()->ip())->count();
}

function cartItems()
{
  return App\Cart::where('ip_address', request()->ip())->get();
}

function cartTotal()
{
    cartItems();
    $sub_total = 0;
    foreach(cartItems() as $item)
    {
      $product_price = App\Product::find($item->product_id)->product_price;
      $sub_total = $sub_total + ($item->cart_amount * $product_price);
    }
    return $sub_total;
}

function averageStar($id)
{
  if(!App\Order_list::where('product_id', $id)->whereNull('star')->exists())
  {
    return 0;
  }
  elseif(App\Order_list::where('product_id', $id)->whereNull('star')->exists())
  {
    return 0;
  }
  else
  {
   return round(App\Order_list::where('product_id', $id)
                            ->whereNotNull('star')
                            ->sum('star')/App\Order_list::where('product_id', $id)
                            ->whereNotNull('review')
                            ->count()); 
  }
}

function getReview($id)
{
  return App\Order_list::where('product_id', $id)->whereNotNull('review')->whereNotNull('star')->get();
}