@extends('layouts.dashboard')
@section('title')
  Coupon
@endsection

@section('active-coupon')
  active
@endsection
@section('nav')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('coupon.index') }}">Coupons</a>
    <span class="breadcrumb-item active">Add Coupon</span>
  </nav>
@endsection
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-8 m-auto">
        @if (session('success'))
          <div class="alert alert-success" role="alert">
              {{ session('success') }}
          </div>
        @endif
        @if ($errors->all())
          <div class="alert alert-danger" role="alert">
              @foreach ($errors->all() as $element)
                <li>{{ $element }}</li>
              @endforeach
          </div>
        @endif
        <div class="card">
          <div class="card-header">
            <h1 class="text-center">{{ isset($coupon) ? 'Edit Coupon' : 'Add Coupon' }}</h1>
          </div>
          <div class="card-body">
            <form class="form-group" action="{{ isset($coupon) ? route('coupon.update', $coupon->id) : route('coupon.store')}}" method="post">
              @csrf
              @isset($coupon)
                {{ method_field('PUT') }}
              @endisset
                <div class="py-3">
                  <input class="form-control" type="text" name="coupon_name" value="{{ isset($coupon) ? $coupon->coupon_name : '' }}" placeholder="Coupon Name">
                </div>
                <div class="py-3">
                  <input class="form-control" type="number" name="discount" value="{{ isset($coupon) ? $coupon->discount : '' }}" placeholder="Discount">
                </div>
                <div class="py-3">
                  <input type="date" name="valid_till" value="{{ isset($coupon) ? $coupon->valid_till : '' }}" class="form-control" min={{ \Carbon\Carbon::now()->toDateString() }}>
                </div>
                <div class="py-3">
                  <button type="submit" class="btn btn-primary">{{ isset($coupon) ? 'Update Coupon' : 'Add Coupon' }}</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
