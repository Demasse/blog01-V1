<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{





    public function __construct(){

        $this->middleware('guest');

    }

    public function showRegistrationForm():View{

        return view('auth.register');

    }

    public function register(Request $request): RedirectResponse{

        $validated = $request->validate([

            'name' =>['required','string','between:5,255'  ],
            'email' =>['required','email', 'unique:users'],
            'password' =>['required','string', 'min:8','confirmed'],
        ]);

        //..

        $validated['password'] = Hash::make(  $validated['password']  );


      //  @dd($validated);

        $user = User::create( $validated );

        Auth::login($user);

        return redirect()->route('home')->withStatus('Inscription reussie');

    }
}
