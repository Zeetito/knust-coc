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
}
