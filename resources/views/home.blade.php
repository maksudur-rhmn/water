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
  <div class="row">
    <div class="col-lg-6 py-3">
      <div class="card">
        <div class="card-header">
          <h5>Seven Days Sale</h5>
        </div>
        <div class="card-body">
           {{  $SevenDaysSaleChart->container()  }}
           {{ $SevenDaysSaleChart->script() }}
        </div>
      </div>
    </div>
    <div class="col-lg-6 py-3">
      <div class="card">
        <div class="card-header">
          <h5>Payment methods</h5>
        </div>
        <div class="card-body">
           {{  $payment_method->container()  }}
           {{ $payment_method->script() }}
        </div>
      </div>
    </div>
  </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Total User :  {{ $total_user }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                      <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                      </tr>
                      @foreach ($users as $user)
                      <tr>
                        <td>{{ $loop-> index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        @if ($user->updated_at)
                          <td>{{ $user->updated_at->diffForHumans() }}</td>
                        @else
                          <td>--</td>
                        @endif
                      </tr>
                    @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
