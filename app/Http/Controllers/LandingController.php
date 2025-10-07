<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contact;

class LandingController extends Controller
{
    //show landing page
    public function landingpage(){
        return view('landing');
    }

    // show contact form
    public function showContactForm()
    {
        return view('contact');
    }

    public function submitContactForm (Request $request){
        // validation of data

        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email',
            'subject' => 'required|string|max:255',
            'message'=>'required|string',
        ]);

        Contact::create($request->only('name','email','subject','message'));

        return redirect()->back()->with('success', 'Your message has been sent!');
    }
}
