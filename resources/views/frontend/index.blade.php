@extends('layouts.frontend')

@section('title')
  Water - Ecommerce Home
@endsection
@section('active-home')
  active
@endsection

@section('content')

    <!-- slider-area start -->
    @include('frontend.includes.slider')
    <!-- slider-area end -->
    <!-- category-area start -->
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    @include('frontend.includes.category', ['categories' => $categories])
    <!-- category-area end -->
    <!-- start count-down-section -->
    @include('frontend.includes.counter')
    <!-- end count-down-section -->
    <!-- bestseller-area start -->
    @include('frontend.includes.best_seller')
    <!-- best seller-area end -->
    <!-- product-area start -->
    @include('frontend.includes.products', ['products' => $products])

    <!-- product-area end -->
    <!-- testmonial-area start -->
    @include('frontend.includes.testimonial')
    <!-- testmonial-area end -->
@endsection
