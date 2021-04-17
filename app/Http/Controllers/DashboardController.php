<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    function index(){
//        $user = new User();
//        $user->firstname = 'Long';
//        $user->lastname = 'Nguyen';
//        $user->dob = '1992-11-18';
//        $user->phone = '09621121020';
//        $user->email = 'ndlong@sdc.udn.vn';
//        $user->group_id = 0;
//        $user->password = Hash::make('123456');
//        $user->save();
        return view();
    }

    function Login(){
        return view('admin.dashboard.login');
    }

    function PostLogin(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
            'password'=>'Password wrong'
        ]);
    }
}
