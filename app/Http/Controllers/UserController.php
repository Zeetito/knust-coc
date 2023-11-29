<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Models\Group;
use App\Models\Guest;
use App\Models\Semester;
use App\Models\GuestRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Helpers\UniqueAcrossTables;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    // Register Fresher Page
    public function create_fresher(){
        return view('account.components.freshers.register');
    }

    // Login Page for Fresher
    public function login_page_fresher(){
        return view('account.components.freshers.login');
    }

    // Student Register 
    public function register_student(){
        return  view('account.components.student.register');
    }
    
    // REGISTER USER
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => ['required', 'min:3', 'max:30'],
            'lastname' => ['required', 'min:3', 'max:30'],
            'othername' => ['nullable', 'max:30'],
            'username' => ['required', 'min:3', 'max:30', new UniqueAcrossTables(['users', 'guests'], 'username')],
            'email' => ['email', 'required', new UniqueAcrossTables(['users', 'guests'], 'email')],
            'password' => ['required', 'confirmed', 'max:225', 'min:6'],
            'dob' => ['required'],
            'gender' => ['required'],
            'contact' => ['required','min:10','max:13'],
            'is_student' => ['required', 'numeric'],
            'is_member' => ['required', 'numeric'],
            'is_fresher' => ['nullable', 'numeric'],
            'is_baptized' => ['required', 'numeric'],
            'is_available' => ['nullable', 'numeric'],
        ]);
        $validated['password'] = bcrypt($validated['password']);
        // Initiate a Guest account
        $guest = new Guest;
        //
        if ($validated['is_member'] == 0) {
            $validated['is_available'] = 0;
            $guest['status'] = "alumini";
        }else{
            $guest['status'] = "member";
        }

        // Check if the Request is coming from the fresher register page
        if ( isset($validated['is_fresher'])){
            $guest['status'] = "fresher";
        }
        // return $validated;
        // First Create A Guest Account for the guest
        
        $guest['fullname'] = $validated['firstname']." ".$validated['lastname'];
        $guest['is_member'] = 1;
        $guest['gender'] = $validated['gender'];
        $guest['email'] = $validated['email'];
        $guest['username'] = $validated['username'];
        $guest['contact'] = $validated['contact'];
        $guest['password'] = $validated['password'];
        $guest->save();

        // Create a Guest request to be granted by a leader
        unset($validated['contact']);
        unset($validated['is_fresher']);

        $account_request = new GuestRequest;
        $account_request['guest_id'] = $guest->id; 
        $account_request['body'] = json_encode($validated); 
        $account_request['type'] = "Account"; 
        $account_request['table_name'] = "users";
        $account_request['model_name'] = "App\Models\User";
        $account_request['resource_name'] = "App\Http\Resources\UserResource";
        $account_request['method'] = "insert";
        $account_request['academic_year_id'] = Semester::active_semester()->academicYear->id;
        $account_request->save();

        return redirect()->back()->with('success','Account Being Processed. You will be notified through Email or Your WhatsApp contact when Completed.');


        // There should be a guest-home page to redirect such guest to
        // return redirect(route('guest-home'))->with('success', 'Account Being Processed. You\'ll be send an Email when it\'s ready. ');
    }

    // LOGIN
    public function login(Request $request)
    {
        //

        if (Auth::check()) {
            return redirect(route('home'))->with('warning', 'You are already logged in.');
        }

        $validated = $request->validate([
            'username' => ['required', 'min:2'],
            'password' => ['required'],
        ]);
        // $validated['password'] = bcrypt($validated['password']);
        if (Auth::attempt($validated)) {

            $request->session()->regenerate();

            return redirect(route('home'))->with('success', 'You have successfully logged in');

            // Check if user has requested an account.
        }else if(Guest::where('username',$validated['username'])->exists() ) {
            return redirect()->back()->with('warning','Account is still being processed. This may take a while');
        }else{
            return redirect()->back()->with('failure', 'password or username incorrect');
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

    // USER IMAGES
    //UPload User Image form
    public function upload_user_image(User $user){
        return view('images.users.create',['user'=>$user]);
    }

    
    // STUDENT
    // View student program mates
    public function view_program_mates(User $user){
        // $program_mates = $user->program_mates;
        return view('users.students.special.program-mates.index',['user'=>$user]);
    }

    // Search Program mates
    public function search_program_mates(User $user, Request $request){

        $users_id = User::search_user($request)
                    ->where('users.is_student',1)
                    ->where('users.is_member', 1)
                    ->join('members_biodatas', 'members_biodatas.user_id', '=', 'users.id')
                    ->where('users.id', '<>', $user->id)
                    ->where('members_biodatas.program_id', $user->program()->id)
                    ->pluck('users.id');
        // return $users_id;
                    

        $users =  User::whereIn('id',$users_id)->get();
        return view('users.students.special.program-mates.search-results',['mates'=>$users, 'user'=>$user]);
    }

    // View User Groups
    public function view_user_groups(User $user){
        return view('groups.user-groups.index',['user'=>$user]);
    }

    // View User Invites
    public function view_user_invites(User $user){
        return view('groups.user-invites.index',['user'=>$user]);
    }




}

