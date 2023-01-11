<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class MyAuthController extends Controller
{
    //
    public function showLogin()
    {
       return view('auth.login');
    }

    public function authenticateLogin(Request $request)
    {
        $array = $request->all();

        $remember = $request->has('remember');

        if (Auth::attempt([
                            'login' => $array['login'],
                            'password' => $array['password']],
                            $remember))
        {
            return redirect()->intended('/admin');
        }

        return redirect()->back()
                        ->withInput($request->only('login', 'remember'))
                        ->withErrors([
                                        'login' => 'Данные аутентификации не верны',
                                    ]);
    }
}
