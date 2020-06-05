<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use Auth;
use Carbon\Carbon;


class GithubController extends Controller
{
  /**
    * Redirect the user to the GitHub authentication page.
    *
    * @return \Illuminate\Http\Response
    */
   public function redirectToProvider()
   {
       return Socialite::driver('github')->redirect();
   }

   /**
    * Obtain the user information from GitHub.
    *
    * @return \Illuminate\Http\Response
    */
   public function handleProviderCallback()
   {
       $user = Socialite::driver('github')->user();


        if(Auth::attempt(['email' => $user->getEmail(), 'password' => 'abc@123']))
        {
          return redirect('/home');
        }
        else{
          User::insert([
            'name'     => $user->getNickname(),
            'email'    => $user->getEmail(),
            'password' => bcrypt('abc@123'),
            'created_at' => Carbon::now(),
          ]);
        }
        if(Auth::attempt(['email' => $user->getEmail(), 'password' => 'abc@123']))
        {
          return redirect('/home');
        }






   }
}
