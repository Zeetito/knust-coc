<?php

namespace App\Http\Controllers;

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    // REGISTER USER
    public function register(Request $request)
    {
        //
        $validated = $request->validate([
            'firstname' => ['required', 'min:3', 'max:30'],
            'lastname' => ['required', 'min:3', 'max:30'],
            'othername' => ['nullable', 'max:30'],
            'username' => ['required', 'min:3', 'max:30', Rule::unique('users', 'username')],
            'email' => ['email', 'required', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'max:225', 'min:6'],
            'dob' => ['required', 'date'],
            'gender' => ['required'],
            'is_student' => ['required', 'numeric'],
            'is_member' => ['required', 'numeric'],
        ]);
        $validated['password'] = bcrypt($validated['password']);
        // Whether the user is available or not would depend on
        if ($validated['is_student' == 0] && $validated['is_member'] == 0) {
            $validated['is_available'] = 0;
        }

        $user = User::create($validated);
        auth()->login($user);

        return redirect(route('home'))->with('success', 'Account Created Successfully. LogIn Now');
    }

    // LOGIN
    public function login(Request $request)
    {
        //

        if (Auth::check()) {
            return redirect(route('home'))->with('info', 'You are already logged in.');
        }

        $validated = $request->validate([
            'username' => ['required', 'min:2'],
            'password' => ['required'],
        ]);
        // $validated['password'] = bcrypt($validated['password']);
        if (Auth::attempt($validated)) {

            $request->session()->regenerate();

            return redirect(route('home'))->with('success', 'You have successfully logged in');
        } else {
            return redirect(route('login'))->with('failure', 'password or username incorrect');
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

    public function logout()
    {
        //
        Auth::logout();

        return redirect(route('login'))->with('success', 'Logged Out Successfully');
    }

    // USER AVATAR
    // View Edit Avatar Form
    public function edit_avatar(User $user)
    {
        return view('profile.edit-avatar', ['user' => $user]);
    }

    // Store/Update User Avatar
    public function store_avatar(Request $request, User $user)
    {
        $request->validate([
            'avatar' => 'required|image|max:5000',
        ]);
        $file = $request->file('avatar');
        $filename = $user->username.'-'.uniqid().'.jpg';
        $oldAvatar = $user->avatar;
        $user = $user;

        // Check if User has changed the profile pic from the default pic already

        // delete existing pic from avatar folder
        Storage::delete('/public/img/avatars/'.$oldAvatar);

        // update the user avatar attribute
        $user->avatar = $filename;
        $user->save();

        // store the new user avatar in avatar folder
        $imgData = Image::make($file)->fit(200)->encode('jpg');
        Storage::put('/public/img/avatars/'.$filename, $imgData);

        if ($oldAvatar != '/default_avatar.jpg') {
            $msg = 'Avatar Updated Successfully';
        }
        $msg = 'New Avatar Uploaded';

        return back()->with('success', $msg);
        // return"Successfylly Added";

        // $this->update_avatar($file,$filename,$oldAvatar,$user);

    }

    // Reset Avatar
    public function reset_avatar(User $user)
    {
        $user['avatar'] = 'default_avatar';
        $user->save();

        return redirect(route('view_profile', $user->id))->with('success', 'Avatar Reset Successful');
    }

    // View All Users
    public function view_users()
    {
        $breadcrumbs = Breadcrumbs::render('view_users');

        return view('users.index',
            [
                'users' => User::paginate(
                    $perPage = 25, $columns = ['*'], $pageName = 'Users'
                ),
                'breadcrumbs' => $breadcrumbs,
            ]
        );
    }

    // STATIC FUNCTIONS

    // Search User
    public function search_user(Request $request)
    {
        $users = User::search_user($request)->paginate($perPage = 25, $columns = ['*'], $pageName = 'Users');

        return view('users.components.users.search-results', ['users' => $users]);

    }

    public function search_user_officiator(Request $request)
    {
        User::search_user($request)->get();
    }
}
