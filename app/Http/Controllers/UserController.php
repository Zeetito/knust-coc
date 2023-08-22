<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        //
        $validated = $request->validate([
            'username'=>['required','min:3','max:30', Rule::unique('users','username')],
            'email'=>['email','required'],
            'password'=>['required','confirmed','max:225','min:6'],
        ]);
        $validated['is_student'] = 1;
        $validated['password'] =  md5($validated['password']) ;
        $user = User::create($validated);
        auth()->login($user);

        return redirect(route('home'))->with('success','Account Created Successfully. LogIn Now');
    }

    /**
     *User LogIn
     */
    public function login(Request $request)
    {
        //
        $validated = $request->validate([
            'username' => ['required','min:2'],
            'password' => ['required'],
        ]);
        $validated['password'] = md5($request['password']);

        if(Auth::attempt(['username'=>$validated['username'], 'password'=>$validated['password'] ])){
            $request->session()->regenerate();
            
                return redirect(route('home'))->with('success','You have successfully logged in');
        }else{
                return redirect(route('login'))->with('failure','password or username incorrect');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function profile(User $user)
    {
        $biodata = $user->biodata;
        // $biodata = User::find(4)->biodata;
        return view('profile.show',['profile' => $biodata]);
    }
}
