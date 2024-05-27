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

        $admin = User::find(1); //assuming there is only 1 admin
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
