<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Email;
use App\Mail\CustomMail;
use App\Mail\AccountCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //

    // Custom Email single user form
    public function custom_email_single_user(User $user){
        return view('emails.custom.single-user',['user'=>$user]);
    }

    // Send Email action
    public function send_email(Request $request){
        $validated =  $request->validate([
            'to'=>['email','required'],
            'subject'=>['required'],
            'body'=>['required'],
        ]);

        $validated['from']  = env('MAIL_FROM_ADDRESS');
        $validated['single_user'] = 1;
        $validated['user_id'] = auth()->id();

        $email = Email::make($validated);

        // Email::create($validated);

        $user = User::where('email',$validated['to'])->first();
        Mail::to($user->email)->send(new CustomMail($email));
        

        return redirect()->back()->with('success',"Email Sent Successfully");


    }
}
