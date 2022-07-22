<?php
   
namespace App\Http\Controllers;
   
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use Exception;
use App\Models\User;
   
class GoogleSocialiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
       
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleCallback()
    {
     
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('email', $user->email)->first();
      
            if($finduser){
                Auth::login($finduser);
               return redirect('/home');
      
            }else{
                return redirect('login')->with('error', 'User does not registered!');
            }
     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}