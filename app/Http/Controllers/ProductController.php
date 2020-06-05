<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Str;
use Carbon\Carbon;
use App\Category;
use Image;
use App\ProductMultipleImage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categories = Category::all();
      $products = Product::all();
      return view('products.index',compact('categories', 'products'));
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
       $slug =  Str::slug($request->product_name) . '-' . Str::random(10);
        // Str::slug($request->product_name) . '-' . Carbon::now()->timestamp;
       $product_id =  Product::insertGetId([

            'product_name'                  => $request->product_name,
            'product_price'                 => $request->product_price,
            'product_short_description'     => $request->product_short_description,
            'product_long_description'      => $request->product_long_description,
            'category_id'                   => $request->category_id,
            'product_thumbnail_image'       => 'hudai.jpg',
            'product_slug'                  => $slug,
            'created_at'                    => Carbon::now(),
    ]);

     $uploaded_image =  $request->file('product_thumbnail_image');
     $filename = $product_id . '.' . $uploaded_image->extension('product_thumbnail_image');
     $location = public_path('uploads/product_thumbnail_image/' . $filename);
     Image::make($uploaded_image)->resize(600, 550)->save($location);

     Product::find($product_id)->update([
       'product_thumbnail_image'  => $filename
     ]);

      $all_images = $request->file('product_multiple_image');

      $counter = 1;

      foreach ($all_images as $single_image) {
        $filename = $product_id . '-' . $counter . '.' .  $single_image->extension('product_multiple_image');
        $location = public_path('uploads/product_multiple_image/' . $filename);
        Image::make($single_image)->resize(600, 550)->save($location);
        ProductMultipleImage::insert([
          'product_id' => $product_id,
          'product_multiple_image' => $filename,
          'created_at'    => Carbon::now(),
        ]);
        $counter++;
      }

     return back()->with('success', 'Product added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      $products = Product::where('product_slug', $slug)->first();
      $related  = Product::where('category_id',  $products->category_id)->where('id', '!=',  $products->id)->get();
      return view('frontend.product_details', compact('products', 'related'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
