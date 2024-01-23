<?php

namespace App\Http\Controllers;

use App\Models\FP;
use App\Models\User;
use Illuminate\Http\Request;

class FPController extends Controller
{
    //

    public function fp(){
        return view('fp.create');
    }


    public function fp_save(Request $request){

        $user =  User::where('email', $request->input('email'))->first();
        if ($user){

            $fp = new FP;
            $fp['email'] = $request->input('email');
            $fp['handled'] = 0;
            $fp->save();

            return redirect()->back()->with('success','You will receive a notification on email.');
        }else{
            return redirect()->back()->with('failure','The email does not exist on our database');

        }

    }

    public function fp_reset_page($email){
        $user =  User::where('email',$email)->first();

        if( FP::where('email',$user->email)->where('handled','0')->exists() == true ){
            return view('fp.reset',['user'=>$user]);
        }else{
            return redirect()->back()->with("warning","You're Not Authorized to perform this action");
        }

    }

    public function fp_reset(Request $request){
        // Validate the password
        $validated = $request->validate([
            'password'=>['confirmed','min:6'],
            'email'=>['email',]
        ]);

        $user = User::where('email',$validated['email'])->first();
        // Update the old password
        $user->password = bcrypt($validated['password']);
        $user->save();

        // mark the FP instance as handled
        $fps = FP::where('email',$user->email)->get();

        foreach($fps as $fp){
            $fp->handled = 1;
            $fp->save();
        }

        return redirect()->route('login')->with('success','password reset Successful. Login Now');

    }

    // View all forgot password Requests
    public function fp_index(){
        return view('fp.index');
    }
}
