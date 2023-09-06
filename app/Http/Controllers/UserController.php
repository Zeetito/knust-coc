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
             'firstname'=>['required','min:5','max:30'],
            'lastname'=>['required','min:5','max:30'],
            'username'=>['required','min:3','max:30', Rule::unique('users','username')],
            'email'=>['email','required', Rule::unique('users','email')],
            'password'=>['required','confirmed','max:225','min:6'],
        ]);
        $validated['is_student'] = 1;
        $validated['password'] =  bcrypt($validated['password']) ;
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

        if (Auth::check()) {
            return redirect(route('home'))->with('info', 'You are already logged in.');
        }
        
        $validated = $request->validate([
            'username' => ['required','min:2'],
            'password' => ['required'],
        ]);
        // $validated['password'] = bcrypt($validated['password']);
        if(Auth::attempt($validated)){

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


    public function logout(User $user)
    {
        //
        Auth::logout();
        return redirect(route('login'))->with('success','Logged Out Successfully');
    }




    public function profile(User $user)
    {
        return $user;
        $biodata = $user->biodata();
        return ($biodata);
        return view('profile.show',['profile' => $biodata , 'user' => $user]);
    }

    public function edit_avatar(){
        $user  = auth()->user();
        return view('profile.edit-avatar',['user'=>$user]);
    }

    public function update_avatar(){
        $user  = auth()->user();
        //
    }
}
