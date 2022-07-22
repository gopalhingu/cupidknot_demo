<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\PrePartners;
use App\Models\PreFamilyTypes;
use App\Models\PreOccupation;

use Hash;

class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {

        return view('auth.login');
    }  
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.register');
    }
    
    /**
     * Write code on Method
     * 
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            return redirect()->intended('dashboard')
            ->withSuccess('You have Successfully logged in');
        }
        
        return redirect("login")->withSuccess('Sorry! You have entered invalid credentials');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
     
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6',
            'gender' => ['required'],
            'dob' => ['required', 'date'],
            'income' => ['required', 'integer'],
            'family_type' => ['required'],
            'occupation' => ['required'],
            'manglik' => ['required'],
            'pre_income' => ['required'],
            'pre_manglik' => ['required'],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' =>$request->gender,
            'dob' =>$request->dob,
            'income' => $request->income,
            'occupation' => $request->occupation,
            'family_type' => $request->family_type,
            'manglik' => $request->manglik,

        ]);
        
        $preIncome = explode('-', $request->pre_income);
        
        $partner = PrePartners::create([
            'user_id' => $user->id,
            'pre_income_from' => $preIncome[0],
            'pre_income_to' => $preIncome[1],
            'pre_manglik' => $request->pre_manglik, 
        ]);

        foreach ($request->pre_occupation as $occupation) {
            PreOccupation::upsert([
                ['partner_id' => $partner->id, 'occupation_id' => $occupation],
            ], ['partner_id', 'occupation_id']);
        }

        foreach ($request->pre_family_type as $type) {
            PreFamilyTypes::upsert([
                ['partner_id' => $partner->id, 'family_type_id' => $type],
            ], ['partner_id', 'occupation_id']);
        }    
        
        return redirect("login")->withSuccess('Great! please login.');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){

         if (Auth::user()->type == 1) {

            return redirect('admin/users');
        } else {

            $users = User::where('id', '!=', Auth::user()->id)->with('prePartner')->get();
            
            $currentUser = User::whereId(Auth::user()->id)->with(['prePartner.preOccupation', 'prePartner.preFamilyType'])->first();
            $countedUsers = [];
            foreach ($users as $user) {
                $countedUsers[] = $this->calPercentage($user);
            }

            array_multisort(array_column($countedUsers, "matchCount"), SORT_DESC, $countedUsers);

            return view('dashboard', compact('countedUsers', 'currentUser'));
        }

            // return view('dashboard');
    }
    
    return redirect("login")->withSuccess('Opps! You do not have access');
}

    /**
     * Write code on Method
     *
     * @return calculatePercentage()
     */

    public function calPercentage($user)
    {
        $matchCount = 0;
        $currentUser = User::whereId(Auth::user()->id)->with(['prePartner.preOccupation', 'prePartner.preFamilyType'])->first();
        
        if (in_array($user->income, range($currentUser->prePartner->preferred_income_from, $currentUser->prePartner->preferred_income_to))) {
            $matchCount = $matchCount + 25;
        }

        if (in_array($user->occupation, $currentUser->prePartner->preOccupation->pluck('occupation_id')->toArray())) {
            $matchCount = $matchCount + 25;

        }
        if ($currentUser->prePartner->pre_manglik == $user->manglik) {
            $matchCount = $matchCount + 25;
        }
        if (in_array($user->family_type, $currentUser->prePartner->preFamilyType->pluck('family_type_id')->toArray())) {
            $matchCount = $matchCount + 25;
        }
        $user['matchCount'] = $matchCount;
        return $user;
    }

    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
    ]);
  }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
        
        return Redirect('login');
    }
}