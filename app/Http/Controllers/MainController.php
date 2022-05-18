<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

class MainController extends Controller
{
    public function index() {

    }

    public function username()
    {
        return 'username'; //or return the field which you want to use.
    }

    public function login(Request $request) {

        // $request->validate([
        //     'username'   => 'required',
        //     'password'  => 'required'
        // ]);

        // $credentials = $request->only('username', 'password');
        // if (Auth::attempt(['username' => $credentials['username'], 'password' => md5($credentials['password']), 'status' => 1])) {
        //     return redirect()->intended('dashboard');
        // } else {
        //     return redirect("/")->withSuccess('Login details are not valid');
        // }
  

        $request->validate([
            'username'   => 'required',
            'password'  => 'required'
        ]);

        $user = DB::table('info_admin')->where([
            ['username', '=', $request->username],
            ['password', '=', md5($request->password)], 
            ['status', '1']]
            )->first();
        if($user) {
            session(['username' => $user->username]);
            return redirect('dashboard');
        } else {
            return back()->with('fail', 'Invalid Credentials.');
        }
    }

    public function logout(Request $request) {
        if($request->session()->has('username')) {
            $request->session()->flush();
            return redirect('/');
        }
    }
}
