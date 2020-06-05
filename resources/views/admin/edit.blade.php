@extends('layouts.dashboard')

@section('title')
  Edit Profile
@endsection


@section('content')

   <div class="container">
     <div class="row">
       <div class="col-lg-6 m-auto">
         <div class="card">
           <div class="card-header">

               <h5 class="text-center">Change Password</h5>
             </div>
             {{-- @if (session('wrongPassword'))
              <div class="alert alert-danger">
                   {{ session('wrongPassword') }}
              </div>
             @endif --}}
             @if ($errors->all())
               <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
               </div>

             @endif
             @if (session('success'))
               <div class="alert alert-success">
                 {{ session('success') }}
               </div>
             @endif
             <div class="card-body">
               <form class="form-group" action="{{ route('passwordpost') }}" method="post">
                 @csrf
                 <div class="py-3">
                   <input class="form-control" type="password" name="old_password" placeholder="Enter Old Password">
                   {{-- @error ('old_password')
                     <small class="text-danger">{{ $message }}</small>
                   @enderror --}}
                 </div>
                 <div class="py-3">
                   <input class="form-control" type="password" name="password" placeholder="Enter New Password">
                 </div>
                 <div class="py-3">
                   <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password">
                 </div>
                 <div class="py-3">
                   <button type="submit" class="btn btn-primary">Change Password</button>
                 </div>

               </form>
             </div>

         </div>
       </div>
     </div>
   </div>

@endsection
