<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(Request $request) {
        // if(!$request->session()->has('username')) {
            return view('auth.login');
        // }
    } 

    public function username() {
        return 'username'; //or return the field which you want to use.
    }

    public function login(Request $request) {
        // $request->validate([
        //     'username' => 'required',
        //     'password' => 'required',
        // ]);

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect('/')
                        ->withErrors($validator)
                        ->withInput();
        }
   
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->withSuccess('Signed in');
        }
  
        return redirect("/")->with('fail', 'Invalid Credentials.');
    }
}
