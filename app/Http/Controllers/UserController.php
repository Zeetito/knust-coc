<?php

namespace App\Http\Controllers;
use App\Models\Role;

use App\Models\User;
use App\Models\Group;
use App\Models\Guest;
use App\Models\Semester;
use App\Models\UserRequest;
use App\Models\GuestRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Helpers\UniqueAcrossTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{


    // View Support
    public function support(){
        return view('help.support.index');
    }

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
            'username' => ['required', 'min:3', 'max:30', 'string', 'regex:/^[a-zA-Z0-9_]+$/',new UniqueAcrossTables(['users', 'guests'], 'username')],
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
            // $validated['is_available'] = 0;
            $guest['status'] = "alumni";
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

        return redirect()->back()->with('success','Account Being Processed. You will receive A notification through Email or WhatsApp When It is ready.');


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
        $username = $validated['username'];
        // Check if user used password
        $user = User::where('email',$validated['username'])->first();
        if($user){
            $validated['username'] = $user->username;
        }

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
        return view('account.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        $validated = $request->validate([
            'firstname' => ['required', 'min:3', 'max:30'],
            'lastname' => ['required', 'min:3', 'max:30'],
            'othername' => ['nullable', 'max:30'],
            'username' => ['required', 'min:3', 'max:30'],
            'email' => ['email', 'required'],
            // 'password' => ['required', 'confirmed', 'max:225', 'min:6'],
            'dob' => ['required'],
            'gender' => ['required'],
            'is_baptized' => ['required', 'numeric'],
        ]);

        $account_unchanged = $validated['username'] == $user->username
                        &&   $validated['firstname'] == $user->firstname
                        &&   $validated['lastname'] == $user->lastname
                        &&   $validated['othername'] == $user->othername
                        &&   $validated['email'] == $user->email
                        &&   $validated['dob'] == $user->dob
                        &&   $validated['gender'] == $user->gender
                        &&   $validated['is_baptized'] == $user->is_baptized
        ;
        
        if($account_unchanged == 1){
            return redirect()->back()->with('warning','No Change Observed');
        }else{

            // Check for change in username and email
            if($validated['email'] != $user->email){
                $revalidate = $request->validate([
                    'email' => ['email', 'required', new UniqueAcrossTables(['users', 'guests'], 'email')],

                ], [
                    'email' => 'This Email is already in Use.',
                   
            ]);
            }

            if($validated['username'] != $user->username){
                $revalidate = $request->validate([
                    'username' => ['required', new UniqueAcrossTables(['users', 'guests'], 'username')],
                ], [
                    'username' => 'This Username is already in Use.',
                   
            ]);
            }



            // Check if user has admin roles
            if(auth()->user()->hasAnyOf(Role::zone_reps_level()->get())){
                $user->update($validated);
                return redirect()->back()->with('success','Account Updated Successfully');
            }else{
                // create a request to update account
                
                if(now()->diffInDays($user->updated_at) < 7) {
                    $days_left = (7- now()->diffInDays($user->updated_at));
                    return redirect()->back()->with('warning','Try again after '.$days_left.' days. Contact Your Rep or any leader if necessary');
                }
                    try{
                        $account_request = new UserRequest;
                        $account_request['user_id'] = $user->id;
                        $account_request['body'] = json_encode($validated); 
                
                        $account_request['method'] = "update";
                        $account_request['instance_id'] = $user->id;
                        
                        $account_request['type'] = "Account";
                        
                        $account_request['model_name'] = "App\Models\User";
                        $account_request['table_name'] = "users"; 


                        $account_request['resource_name'] = "App\Http\Resources\UserResource";
                        
                        $account_request['academic_year_id'] = Semester::active_semester()->academicYear->id;
                        $account_request->save();

                        return redirect()->back()->with('success','Done! Changes will reflect soon');
                        
                        } catch (QueryException $e) {
                            Log::error($e);
                        
                            $errorCode = $e->errorInfo[1];

                            if ($errorCode == 1062) {
                                // Redirect to a custom error page for duplicate entry
                                return redirect()->back()->with('warning', 'Your Previous Account Update is being processed');
                            }

                            throw $e;

                        }
            }





        }
    }

    // Confrim Password form
    public function account_confirm_password(User $user){
        return view('account.confirm-password',['user'=>$user]);
        
    }

    // Account Check Password
    public function account_new_password(Request $request, User $user){

        $logins['username'] = auth()->user()->username;
        $logins['password'] = $request->input('password');

        if (Auth::attempt($logins)) {

            return view('account.change-password',['user'=>$user]);

            // Check if user has requested an account.
        }else{
            return redirect(route('edit_user',['user'=>$user]))->with('failure', 'You cannot perform this action');

        }


        // return view('')
    }

    public function change_password(Request $request,User $user){
        $validated = $request->validate([
            'password'=>['confirmed','required'],
        ]);
            $user->password = bcrypt($validated['password']);
            $user->save();
            return redirect(route('edit_user',['user'=>$user]))->with('success', 'Password Changed!');

    }


    // Confrim Delete User
    public function confirm_delete(User $user)
    {
        return view('account.delete',['user'=>$user]);
    }

    // Delete User
    public function delete(User $user, Request $request){
        $validated = $request->validate([
            'password'=>['required'],
        ]);
        $logins['password'] = $validated['password'];
        $logins['username'] = auth()->user()->username;

        if (Auth::attempt($logins)) {

            $user->delete();

            return redirect()->back()->with('warning', 'Account Deleted!');

            // Check if user has requested an account.
        }else{
            return redirect()->back()->with('failure', 'You cannot perform this action');

        }


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
        'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('avatar')) {
        $avatar = $request->file('avatar');

        // Generate a unique filename based on the user's ID and original extension
        $filename = 'user_' . $user->id . '_avatar.' . $avatar->getClientOriginalExtension();

        // Resize and store the image
        $image = Image::make($avatar)->fit(200, 200); // Adjust dimensions as needed
        Storage::put('public/img/avatars/' . $filename, $image->encode());

        // Update the user's avatar field in the database with the filename
        $user->avatar = $filename;
        $user->save();
        //

        return redirect()->back()->with('success', 'Avatar uploaded successfully');
    }

    return redirect()->back()->with('error', 'Avatar upload failed');
}

    // public function store_avatar(Request $request, User $user)
    // {
    //     $request->validate([
    //         'avatar' => 'required|image|max:5000',
    //     ]);
    //     $file = $request->file('avatar');
    //     $filename = $user->username.'-'.uniqid().'.jpg';
    //     $oldAvatar = $user->avatar;
    //     $user = $user;

        // Check if User has changed the profile pic from the default pic already

        // delete existing pic from avatar folder
        // Storage::delete('/public/img/avatars/'.$oldAvatar);

        // update the user avatar attribute
        // $user->avatar = $filename;
        // $user->save();

        // store the new user avatar in avatar folder
        // $imgData = Image::make($file)->fit(200)->encode('jpg');
        // Storage::put('/public/img/avatars/'.$filename, $imgData);

        // if ($oldAvatar != '/default_avatar.jpg') {
        //     $msg = 'Avatar Updated Successfully';
        // }
        // $msg = 'New Avatar Uploaded';

        // return back()->with('success', $msg);
        // return"Successfylly Added";

        // $this->update_avatar($file,$filename,$oldAvatar,$user);

    // }

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





    // View User Invites
    public function view_user_invites(User $user){
        return view('groups.user-invites.index',['user'=>$user]);
    }




}

