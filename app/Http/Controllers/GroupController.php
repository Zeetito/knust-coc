<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    //

    // Show Group
    public function show(Group $group){
        $group_type = $group->groupable_type;
        if($group_type == "App\Models\DTD"){
            return redirect(route('show_dtd_group',['group'=>$group]));
        }

        // Other Model types aside DTD too would follow

        // General groups would not have any groupable_type
    }

    // Show User Groups
        // View User Groups
        public function view_user_groups(User $user){
            $groups = Group::where('groupable_type','!=','App\\Models\\DTD')->get();
            return view('groups.user-groups.index',['user'=>$user,'groups'=>$groups]);
    
        }

    // Edit Group
    public function edit(Group $group){
        return view('groups.edit',['group'=>$group]);
    }

    // Update Group
    public function update(Group $group, Request $request){
        $validated =  $request->validate([
            'name'=>['required'],
            'info'=>['nullable'],
        ]);

        $group->name = $validated['name'];
        $group->info = $validated['info'];
        $group->updated_at = now();
        $group->save();
        return redirect()->back()->with('success','Update Successful');

    }

    // Store Group
    public function store(Request $request){

    }   

    // Confirm Delete
    public function confirm_delete(Group $group){
        return view('groups.delete',['group'=>$group]);
    }

    // Delete 
    public function delete(Group $group, Request $request){
        
        $validated = $request->validate(['response'=>'required','numeric']);
        if($validated['response'] == 1){
            $group->delete();
            return redirect()->back()->with('warning','Group Deleted');
        }

    }
        

    // Create Invite
    public function create_invite(Group $group){
        $users =  User::where('is_member',1)->get();
        return view('groups.user-invites.create',['group'=>$group, 'users'=>$users]);
    }

    // Store Invite
    public function store_invite(Group $group, Request $request){
        $validated = $request->validate(['user_id'=>'required','numeric']);


        // Check If Instance Exist
        $instance = DB::table('group_users')->where('user_id',$validated['user_id'])->where('group_id',$group->id)->first();
        if($instance){
            if($instance->is_member == 0){
                return redirect()->back()->with('warning','Invite Already Sent');
            }elseif($instance->is_member == 1){
                return redirect()->back()->with('warning','User is a member already');
            }
        }



        $validated['group_id'] = $group->id;
        $validated['is_member'] = 0;
        $validated['is_admin'] = 0;
        $validated['created_by'] = auth()->user()->id;
        $validated['created_at'] = now();
        $validated['updated_at'] = now();
        
        DB::table('group_users')->insert($validated);

        return redirect(route('show_dtd_group',['group'=>$group]))->with('success','Invite Successful');
    }

    // Hangle  Invite Form
    public function handle_invite_form(User $user, Group $group){
        $host_id = DB::table('group_users')->where('user_id',$user->id)->where('group_id',$group->id)->first()->created_by;
        $host = User::find($host_id);
        return view('groups.user-invites.edit',['user'=>$user,'group'=>$group, 'host'=>$host]);
    }


    // Handle Invite
    public function handle_invite(User $user, Group $group, Request $request){
        $validated = $request->validate(['response'=>'required','numeric']);
        $instance = DB::table('group_users')->where('user_id',$user->id)->where('group_id',$group->id);

        if($validated['response'] == 1){
            $validated['updated_at'] = now();
            $validated['is_member'] = 1;
            unset($validated['response']);

            // Update Instance 
            $instance->update($validated);
            return redirect(route('show_dtd_group',['group'=>$group]))->with('success','Invite Accepted');
        }else{
           $instance->delete();
           return redirect(route('view_user_invites',['user'=>$user]))->with('warning','Invite Denied');
        }


    }

    // Show All Invites For A Group
    public function invites(Group $group){
        return view('groups.invited-users.index',['group'=>$group]);
    }

    // Confirm INvte Delete
    public function confirm_invite_delete(Group $group, User $user){
        return view('groups.invited-users.delete',['group'=>$group,'user'=>$user]);
    }

    // Delete Invite
    public function delete_invite(Group $group, User $user, Request $request){
        $validated = $request->validate(['response'=>'required','numeric']);
        $instance = DB::table('group_users')->where('user_id',$user->id)->where('group_id',$group->id);

        if($validated['response'] == 1){
            $instance->delete();
            return redirect()->back()->with('warning','Invite Deleted!');
        }else{
            return redirect()->back()->with('failure','Select A Valid response');

        }

    }


    // Confirm Making User Admin
    public function confirm_make_admin(Group $group, User $user){
        return view('groups.user-groups.admin.create',['user'=>$user,'group'=>$group]);
    }

    // Make User Admin
    public function make_admin(Group $group, User $user, Request $request){
        $validated = $request->validate(['response'=>'required','numeric']);
        if($validated['response'] == 1){
            $instance = DB::table('group_users')->where('user_id',$user->id)->where('group_id',$group->id);
            $update['is_admin'] = 1;
            $instance->update($update);
            return redirect()->back()->with('success','Status Updated Successfully');
        }
    }
    
    // Confirm Admin Withdrawal
    public function confirm_admin_withdraw(Group $group, User $user){
        return view('groups.user-groups.admin.delete',['user'=>$user,'group'=>$group]);
    }

    // Make User Admin
    public function withdraw_admin_role(Group $group, User $user, Request $request){
        $validated = $request->validate(['response'=>'required','numeric']);
        if($validated['response'] == 1){
            $instance = DB::table('group_users')->where('user_id',$user->id)->where('group_id',$group->id);
            $update['is_admin'] = 0;
            $instance->update($update);
            return redirect()->back()->with('warning','Status Updated Successfully');
        }
    }

    // Confirm Remove User
    public function confirm_remove_user(Group $group, User $user){
        return view('groups.user-groups.delete',['user'=>$user,'group'=>$group]);
    }

    // Make User Admin
    public function remove_user(Group $group, User $user, Request $request){
        $validated = $request->validate(['response'=>'required','numeric']);
        if($validated['response'] == 1){
            $instance = DB::table('group_users')->where('user_id',$user->id)->where('group_id',$group->id);
            $instance->delete();
            return redirect()->back()->with('failure','Memeber Removed');
        }
    }

    // Skip Invite page
    public function skip_invite_page(Group $group){
        $users =  User::all();
        return view('groups.user-invites.skip-invite',['group'=>$group,'users'=>$users]);
    }
    
    // Skip invite
    public function skip_invite(Group $group, Request $request){
        $validated = $request->validate(['user_id'=>'required','numeric']);


        // Check If Instance Exist
        $instance = DB::table('group_users')->where('user_id',$validated['user_id'])->where('group_id',$group->id)->first();
        if($instance){
            if($instance->is_member == 0){
                return redirect()->back()->with('warning','Invite Already Sent');
            }elseif($instance->is_member == 1){
                return redirect()->back()->with('warning','User is a member already');
            }
        }
    

            $validated['group_id'] = $group->id;
            $validated['is_member'] = 1;
            $validated['is_admin'] = 0;
            $validated['created_by'] = auth()->user()->id;
            $validated['created_at'] = now();
            $validated['updated_at'] = now();
            
            DB::table('group_users')->insert($validated);

        return redirect(route('show_dtd_group',['group'=>$group]))->with('success','User Added Successfully');
    }
}

