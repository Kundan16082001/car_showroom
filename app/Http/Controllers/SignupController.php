<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    //Show Signup form:
        public function create(){
            return view('signup');
        }

    // store procedure:

    public function store(Request $request){
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6|confirmed',
            'role'=>'required|in:admin,customer',
        ]);

    // create data in database
    User::create([
        'name'=> $request->name,
        'email'=> $request->email,
        'password'=>Hash::make($request->password),
        'role'=>$request->role,
    ]);

    // return redirect o login
    return redirect()->route('login')->with('success','signup successfully');
 }
}