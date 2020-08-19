<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use App\User;

class SocialController extends Controller
{
    public function redirect($provider)
	{
	     return Socialite::driver($provider)->redirect();
	}

	public function callback($provider)
	{
	   $getInfo = Socialite::driver($provider)->user(); 
	   $user = $this->createUser($getInfo,$provider); 
	   auth()->login($user); 
	   return redirect()->to('/');
	}

	function createUser($getInfo,$provider){
		$user = User::where('provider_id', $getInfo->id)->first();
		if (!$user) {
	      $user = User::create([
	         'name'     => $getInfo->name,
	         'email'    => $getInfo->email,
	         'level'    => 1,
	         'provider' => $provider,
	         'provider_id' => $getInfo->id
	     ]);
	    \session()->put('email',$getInfo->email);
	    \session()->put('user_name',$getInfo->name);
	   }else {
	   	\session()->put('email',$getInfo->email);
	   	\session()->put('user_name',$getInfo->name);
	   }
	   return $user;
	}

	// google

	public function redirectToProvider()
	{
	    return Socialite::driver('google')->redirect();
	}

	public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }
        // only allow people with @company.com to login
        if(explode("@", $user->email)[1] !== 'gmail.com'){
            return redirect()->to('/');
        }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            // log them in
            \session()->put('email',$user->email);
	    	\session()->put('user_name',$user->name);
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->level           = 1 ;
            $newUser->google_id       = $user->id;
            $newUser->avatar          = $user->avatar;
            $newUser->avatar_original = $user->avatar_original;
            $newUser->save();
            \session()->put('email',$newUser->email);
	    	\session()->put('user_name',$newUser->name);
        }
        return redirect()->to('/');
    }
}
