<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    //  access modifiers -> public, protected, private

    public function login(Request $request){
        return view('Auth.login');
    }


    public function userLogin(Request $request) {
        dd(request()->all());
    }

    public function register(Request $request){
        return view('Auth.register');
    }

    public function userRegister(Request $request) {

        $validated = $request->validate([
            // 'title' => 'required|unique:posts|max:255',
            // 'body' => 'required',

            'first_name' => 'required|min:3|max:30',
            'last_name'  => 'required|min:3|max:30',
            'email'      => 'required|email',
        ]);

        dd( request()->all() );
    }
}
