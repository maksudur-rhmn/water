<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Auth;
use Hash;
use App\User;
use App\Mail\PasswordChange;

class ProfileController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('verified');
  }

  function changepassword()
  {
    return view('admin.edit');
  }

  function passwordpost(Request $request)
  {
    $request->validate([
      'old_password'  => 'required',
      'password'      => 'required|confirmed',
      'password_confirmation'  => 'required'
    ]);
   $db_password = Auth::user()->password;

   if($request->old_password == $request->password)
   {
     return back()->withErrors('Iftyr moton jaura polapain dorkar nai');
   }
   else{
     if(Hash::check($request->old_password, $db_password))
     {
         User::findOrFail(Auth::user()->id)->update([
         'password'  => Hash::make($request->password)
       ]);
       // Mail::to(Auth::user()->email)->send(new PasswordChange());
       // $new_password = $request->password;
       Mail::to(Auth::user()->email)->send(new PasswordChange());
       return back()->with('success', 'Your Password has been changed');
     }
     else
     {
       return back()->withErrors('Old Password do not match');
     }
   }


  // END
  }





  // END
}
