<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function create(){
        return view('auth.login');
    }
    public function store(Request $request){
        $credentials=$request->only('email', 'password');

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended(route('movies.index'))
            ->with('success', 'You have successfully logged in.');
        }
    
    return back()->withErrors([
        'email'=>'The provided credentials do not match our records.',
    ])->onlyInput('email');
}

    public function destroy(Request $request){

    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('login')
    ->with('success', 'You have been logged out.');
    }
}