
@extends('layouts.dashboard')

@section('title')
  Home
@endsection

@section('active-home')
  active
@endsection

@section('nav')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
    {{-- <a class="breadcrumb-item" href="index.html">Pages</a>
    <span class="breadcrumb-item active">Blank Page</span> --}}
  </nav>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
               <h1 class="text-center">All Orders !!!</h1>
            </div>
            <div class="card-body">
              @if(session('status'))
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
            @endif
            @if(session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif
              <table class="table table-dark table-striped">
                 <tr>
                   <th>SL NO.</th>
                   <th>Order Number</th>
                   <th>email</th>
                   <th><i class="fa fa-phone" aria-hidden="true"></i></th>
                   <th>Action</th>
                 </tr>
                 @forelse($orders as $index => $order)
                 <tr>
                   <th>{{ $loop-> index + 1 }}</th>
                   <th>{{ $order->id }}</th>
                   <th>{{ $order->email }}</th>
                   <th>{{ $order->phone_number }}</th>
                   <th>
                     <div class="btn-group">
                       <a href="{{ route('download.pdf', $order->id) }}" class="btn btn-primary btn-sm">Download</a>
                       <a href="{{ route('send.text', $order->id) }}" class="btn btn-danger btn-sm">Send Text message</a>
                     </div>
                   </th>
                 </tr>
                    @empty
                    <tr>
                      <td>No data Available</td>
                    </tr>

                 @endforelse
              </table>
    </div>
</div>
@endsection
