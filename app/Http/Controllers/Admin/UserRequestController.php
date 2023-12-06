<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Zone;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class UserRequestController extends Controller
{
        // USER REQUESTS
    // View All User Request
    public function show_user_requests(){
        return view('ADMIN.dashboard.components.user-requests.index');
    }
    //
    // Search User request
    public function search_user_requests(Request $request)
    {
        $users = User::search_user($request)->get()->pluck('id');
        
        $requests = UserRequest::where('is_granted',0)
                ->whereIn('user_id',$users)
                ->get()
                ;
        return view('ADMIN.dashboard.components.user-requests.search-results', ['requests' => $requests]);
    }

    // Search Users with Request
    public function search_user_with_request(Request $request){
        $users_id = User::search_user($request)->get()->pluck('id');
        
        $users = User::users_with_pending_request()
                ->whereIn('id',$users_id)
                ->get()
                ;
        return view('ADMIN.dashboard.components.user-requests.search-results', ['users' => $users]);
    }

    // Filter User requests
    // Filter Unavailable Users
    public function filter_user_requests(Request $request)
    {
        // Check the string value of the request
        $string = $request->input('str');
        if (empty($string)) {
            $users = User::users_with_pending_request()
                ->get()
                ;
            // If the String is empty
        } elseif (! empty($string)) {

            if($string == "members"){
                $users = User::users_with_pending_request()
                ->get()
                ->intersect(User::where('is_member',1)->get())
                ;
            }elseif($string == "alumni"){
                $users = User::users_with_pending_request()
                ->get()
                ->intersect(User::where('is_member',0)->get())
                ;
            }else{
                $users = User::users_with_pending_request()
                ->get()
                ->intersect(Zone::find($string)->users())
                ;
            }

          
        }
        // Check for other filters like latest, oldest and thigns
        return view('ADMIN.dashboard.components.user-requests.search-results', ['users' => $users]);
    }

    // Edit User Request - Modal
    public function edit_user_request(UserRequest $user_request){
        $old_resource_data = DB::table($user_request->table_name)->where("id", $user_request->instance_id)->first();
        $old_resource = new ($user_request->resource_name)($old_resource_data);
        $old_resource = json_decode(json_encode($old_resource,true));
        
        $new_resource_data = json_decode($user_request->body, true);
        $new_resource_data = ($user_request->model_name)::make($new_resource_data);
        $new_resource = new ($user_request->resource_name)($new_resource_data);
        $new_resource = json_decode(json_encode($new_resource,true));

        return view('ADMIN.dashboard.components.user-requests.edit', ['user_request' => $user_request, 'old_resource'=>$old_resource, 'new_resource'=>$new_resource]);
    }

    // Handle User Request
    public function handle_user_request(UserRequest $user_request, Request $request){
        $validated = $request->validate([
            'action' => ['required']
        ]);
        
            if($validated['action'] == 'grant'){

                // Check if it's an insert method
                if($user_request->method == 'insert'){

                    $body = json_decode($user_request->body, true);
                    $body['created_at'] = now();
                    $body['updated_at'] = now();
                    // Create New Table Instance
                    $result = DB::table($user_request->table_name)->{$user_request->method}($body);
                    // Get the Instance_id
                    if ($result) {
                        // Retrieve the last inserted ID
                        $instance_id = DB::getPdo()->lastInsertId();
                    }
                    // Update the request as one handled/denied
                    $user_request->handle_method ="granted";
                    $user_request->is_handled = 1;
                    $user_request->handled_on = now();
                    $user_request->handled_by = auth()->user()->id;
                    $user_request->instance_id = $instance_id;
                    $user_request->save();
                   
                    return redirect()->back()->with('success','Grant Success'); 

                    // Check if it's Update
                }elseif($user_request->method == 'update'){
                    // First Get the Body 
                    $body = json_decode($user_request->body, true);
                    $body['updated_at'] = now();
                    // Get The Instance to Be updated
                    $old_instance = DB::table($user_request->table_name)
                                        ->where("id",$user_request->instance_id)
                                        ;

                    // Do the update here
                    $old_instance->{$user_request->method}($body);

                    // Update the request as one handled/denied
                    $user_request->handle_method ="granted";
                    $user_request->is_handled = 1;
                    $user_request->handled_on = now();
                    $user_request->handled_by = auth()->user()->id;
                    $user_request->save();
                    return redirect()->back()->with('success','Grant Success'); 

                    // Check if it's Delte
                }elseif($user_request->method == 'delete'){
                    return "Delete";
                }

            }else{
                    $user_request->handle_method ="denied";
                    $user_request->is_handled = 1;
                    $user_request->handled_on = now();
                    $user_request->handled_by = auth()->user()->id;
                    $user_request->save();
                    return redirect()->back()->with('warning','Request Denied Successful'); 
            }

    
    }

}
