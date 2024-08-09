<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    public function __construct(){

        $this->middleware('guest')->except('logout');
       // $this->middleware('auth')->except('logout');

    }



    public function showLoginForm():View{

        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse{

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required','string'],
        ]);


       // dd($request);


        if (Auth::attempt($credentials , (bool) $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return back()->withErrors([
            'email' => 'identigiant errones',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
        {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

        }

}
