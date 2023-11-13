<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\BiodataResource;

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

    // Filter User requests
    // Filter Unavailable Users
    public function filter_user_requests(Request $request)
    {
        // Check the string value of the request
        $string = $request->input('str');
        if ($string == 'update' || $string == 'create' || $string == 'delete') {
            $requests = User::user_requests()->where('method',"$string")
                ->get()
                ;
            // If the String is empty
        } elseif (! empty($string)) {
            $requests = User::user_requests()
                ->get()
                ;
        }
        // Check for other filters like latest, oldest and thigns
        return view('ADMIN.dashboard.components.user-requests.search-results', ['requests' => $requests]);
    }

    // Edit User Request - Modal
    public function edit_user_request(UserRequest $user_request){
        $old_resource = new BiodataResource((DB::table($user_request->table_name)->where("id",$user_request->instance_id)->first()));
        $old_resource = json_decode(json_encode($old_resource,true));
        
        $body = json_decode($user_request->body, true);
        unset($body['created_at']);
        unset($body['updated_at']);
        // return $body;
        $new_resource = new BiodataResource($body);
        // return $new_resource;
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
                    // Unset the Instance Id since it'd cuase confusion and we don't need it

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
                    return "Delete The guy Nana";
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
