<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function home()
    {
        // return the admin dashboard page
        return view('ADMIN/dashboard/home');
    }
    // USER RELATED

    // INACTIVE ACCOUNTS
    // Show Inactive Accounts
    public function show_inactive_accounts()
    {
        return view('ADMIN.dashboard.components.inactive-accounts.index');
    }

    // Search Inactive Users
    public function search_inactive_user(Request $request)
    {
        $users = User::search_user($request)->get()->intersect(User::inactive_accounts()->get());

        // $users = $users->where('is_activated',0)->get();
        return view('ADMIN.dashboard.components.inactive-accounts.search-results', ['users' => $users]);
    }

    // Filter Inactive Users
    public function filter_inactive_users(Request $request)
    {
        // Check the string value of the request
        $string = $request->input('str');
        if ($string == 'fresher' || $string == 'suspended' || $string == 'new_account') {
            $users_id = User::inactive_accounts()
                ->get()
                ->pluck('id')
                ->intersect(
                    DB::table('inactive_accounts')
                        ->where('reason', "$string")
                        ->pluck('user_id')
                );
            // If the String is empty
        } elseif (! empty($string)) {
            $users_id = User::inactive_accounts()
                ->get()
                ->pluck('id');
        }
        // Check for other filters like latest, oldest and thigns

        $users = User::whereIn('id', $users_id)->get();

        return view('ADMIN.dashboard.components.inactive-accounts.search-results', ['users' => $users]);
    }

    // Edit Inactive Account Status
    public function edit_inactive_account_status(User $user)
    {
        return view('ADMIN.dashboard.components.inactive-accounts.edit', ['user' => $user]);
    }

    // Update inactive Account Status
    public function update_inactive_account_status(Request $request, User $user)
    {
        $validated = $request->validate([
            'is_activated' => ['required', 'numeric'],
        ]);
        $validated['user_id'] = $user->id;

        // Insert Or Update the instance
        DB::table('inactive_accounts')
            ->where('user_id', $user->id)
            ->delete();

        $user->is_activated = 1;
        $user->save();

        return redirect()->back()->with('warning', 'User Account Status Updated Successfully');
    }

    // UNAVAILABLE MEMBERS
    // Show Unavailable Members
    public function show_unavailable_members()
    {
        return view('ADMIN.dashboard.components.unavailable-members.index');
    }

    // search_umavailable_members
    public function search_unavailable_members(Request $request)
    {
        $users = User::search_user($request)->get()->intersect(User::unavailable_members()->get());

        // $users = $users->where('is_activated',0)->get();
        return view('ADMIN.dashboard.components.unavailable-members.search-results', ['users' => $users]);
    }

    // Filter Unavailable Users
    public function filter_unavailable_members(Request $request)
    {
        // Check the string value of the request
        $string = $request->input('str');
        if ($string == 'sick' || $string == 'travelled' || $string == 'not_yet_in') {
            $users_id = User::unavailable_members()
                ->get()
                ->pluck('id')
                ->intersect(
                    DB::table('unavailable_members')
                        ->where('category', "$string")
                        ->pluck('user_id')
                );
            // If the String is empty
        } elseif (! empty($string)) {
            $users_id = User::unavailable_members()
                ->get()
                ->pluck('id');
        }
        // Check for other filters like latest, oldest and thigns

        $users = User::whereIn('id', $users_id)->get();

        return view('ADMIN.dashboard.components.unavailable-members.search-results', ['users' => $users]);
    }

    // Edit Unavailable Members Status
    public function edit_unavailable_members_status(User $user)
    {
        return view('ADMIN.dashboard.components.unavailable-members.edit', ['user' => $user]);
    }

    // Update Unavailable Member Status
    public function update_unavailable_members_status(Request $request, User $user)
    {
        $validated = $request->validate([
            'is_available' => ['required', 'numeric'],
        ]);
        $validated['user_id'] = $user->id;

        // Insert Or Update the instance
        DB::table('unavailable_members')
            ->where('user_id', $user->id)
            ->delete();

        $user->is_available = 1;
        $user->save();

        return redirect()->back()->with('success', 'User Availability Status Updated Successfully');
    }

    // mark_unavailable_confirm
    public function mark_unavailable_confirm(User $user)
    {
        return view('ADMIN.dashboard.components.unavailable-members.mark-user-unavailable',['user'=>$user]);
    }

    // Mark User Unavailable
    public function mark_user_unavailable(Request $request, User $user)
    {   
        if($user->is_available){
            $validated = $request->validate([
                'is_available' => ['required', 'numeric'],
                'category'=> ['required'],
                'info' => ['min:5','required']
            ]);
                $validated['user_id'] = $user->id;
                $validated['recorded_by'] = auth()->user()->id;
                unset($validated['is_available']);
            DB::table('unavailable_members')->insert($validated);

            $user->is_available = 0;
            $user->save();

            return redirect()->back()->with('warning','User Marked Unavailable');



        }else{
            return redirect()->back()->with('failure','User is already Unavailable');
        }
    }

    // Mark User Inactive confirm
    public function mark_user_inactive_confirm(User $user){
        return view('ADMIN.dashboard.components.inactive-accounts.mark-user-inactive',['user'=>$user]);
    }

    // Mark User Inactive
    public function mark_user_inactive(Request $request, User $user)
    {   
        if($user->is_activated){
            $validated = $request->validate([
                'is_activated' => ['required', 'numeric'],
                'category'=> ['required'],
                'info' => ['min:5','required']
            ]);
                $validated['user_id'] = $user->id;
                $validated['action_by'] = auth()->user()->id;
                unset($validated['is_activated']);
            DB::table('inactive_accounts')->insert($validated);

            $user->is_activated = 0;
            $user->save();

            return redirect()->back()->with('warning','User Marked Inactive');

        }else{
            return redirect()->back()->with('failure','User Account is already Inactive');
        }
    }
    

    // Show Users without biodata
    public function without_biodata(){
        return view('ADMIN.dashboard.components.without-biodata.index');
    }

    // Search Users without biodata
    public function search_users_without_biodata(Request $request){
        $users = User::search_user($request)->get()->intersect(User::without_biodata()->get())->sortByDesc('created_at');

        // $users = $users->where('is_activated',0)->get();
        return view('ADMIN.dashboard.components.without-biodata.search-results', ['users' => $users]);
    }

    // Filter Unavailable Users
    public function filter_users_without_biodata(Request $request)
    {
        // Check the string value of the request
        $string = $request->input('str');
        if ($string == 'member' || $string == 'alumni') {
            $users_id = User::without_biodata()
                ->where('is_member',($string == "member" ? 1 : 0) )
                ->get()
                ->pluck('id')
                ;
            // If the String is empty
        } elseif (! empty($string)) {
            $users_id = User::without_biodata()
                ->get()
                ->pluck('id');
        }
        // Check for other filters like latest, oldest and thigns

        $users = User::whereIn('id', $users_id)->get()->sortByDesc('created_at');
        return view('ADMIN.dashboard.components.without-biodata.search-results', ['users' => $users]);

    }


    // USER STATISTICS

    // View Members Statistics Page
    public function stats_members(){
        return view('ADMIN.dashboard.components.users-statistics.members.index');
    }
    

    // View Visitation Guide
    public function view_visitation_guide(){
        return view('ADMIN.dashboard.components.users-statistics.members.details.visitation-guide');
    }

    // remind_profile_update
    public function remind_profile_update(User $user){
        return view('ADMIN.dashboard.components.without-biodata.reminder',['user'=>$user]);
    }

    

}
