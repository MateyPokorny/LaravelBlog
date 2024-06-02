<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $admin = User::find(1); //je predpokladany jen jeden admin s id = 1
        if((Hash::check($request->password, $admin->password)))
        {
            auth()->login($admin);
            return redirect()->route('home');
        }

        else
        return back()->with('password_status','špatný heslo :(');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }
}
