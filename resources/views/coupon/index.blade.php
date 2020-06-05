@extends('layouts.dashboard')
@section('title')
  Coupon
@endsection

@section('active-coupon')
  active
@endsection
@section('nav')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
    <span class="breadcrumb-item active">Coupon</span>
  </nav>
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-8 m-auto">
        <div class="d-flex float-right mb-3">
          <a href="{{ route('coupon.create') }}" class="btn btn-success">Add Coupon</a>
        </div>
        <table class="table table-striped">
          <tr>
            <th>SL</th>
            <th>Coupon Name</th>
            <th>Coupon Discount</th>
            <th>Valid Till</th>
            <th>Created at</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          @foreach ($coupons as $coupon)
          <tr>
            <td>{{ $loop->index +1 }}</td>
            <td>{{ $coupon->coupon_name }}</td>
            <td>{{ $coupon->discount }} %</td>
            <td>{{ $coupon->valid_till }}</td>
            <td>{{ $coupon->created_at->format('Y-m-d') }}</td>
            <td>
              @if ($coupon->valid_till >= \Carbon\Carbon::now()->format('Y-m-d'))
                <span class="badge badge-success">{{ \Carbon\Carbon::parse($coupon->valid_till)->diffInDays(\Carbon\Carbon::now()->format('Y-m-d')) }} Days left</span>
              @else
                <span class="badge badge-danger">Expired</span>
              @endif
            </td>
            <td>
              <a href="{{ route('coupon.edit', $coupon->id) }}" class="btn btn-warning">Edit</a>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
@endsection
