<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\PasswordMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class PasswordController extends Controller
{
    // use ;

     /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */

    
    // Forgot Password Form
    public function forgot_password(){
        return view('users.auth.forgot-password');
    }


    public function send_reset_link(Request $request)
    {
       $user = User::where('email',$request->email)->first();
       if($user)
       {
            $user->remember_token = Str::random(40);
            $user->save();
            
            Mail::to($user)->send(new PasswordMail($user));

            return redirect()->back()->with('success','Please Check you email and reset your password');

       }
       else
       {
            return redirect()->back()->with('failure','The Email does not exist on our database');
       }
    }


    // Reset Password Form
    public function reset_password(){
        return view('users.auth.reset-password');
    }

    // Update Password
    public function udpate_password(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);

    }


}
