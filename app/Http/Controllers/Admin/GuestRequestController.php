<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\AccountCreated;
use App\Models\GuestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class GuestRequestController extends Controller
{
    //
        // Edit Guest Request - Modal
        public function edit_guest_request(GuestRequest $guest_request){


            // Check if it's an insert, update or delete request
            if($guest_request->method == 'insert'){

                $new_resource_data = json_decode($guest_request->body, true);
                $new_resource_data = ($guest_request->model_name)::make($new_resource_data);
                $new_resource = new ($guest_request->resource_name)($new_resource_data);
                $new_resource = json_decode(json_encode($new_resource,true));

            }elseif($guest_request->method == 'update'){

            }elseif($guest_request->method == 'delete'){

            }


            return view('ADMIN.dashboard.components.guest-requests.edit', ['guest_request' => $guest_request, 'new_resource'=>$new_resource]);
        }
    
        // Handle Guest Request - Deny or Grant
        public function handle_guest_request(GuestRequest $guest_request, Request $request){
            $validated = $request->validate([
                'action' => ['required']
            ]);
            
                if($validated['action'] == 'grant'){
                  
                    self::grant_request($guest_request);

                    return redirect()->back()->with('success','Grant Success');  

    
                }else{
                    self::deny_request($guest_request);
                    return redirect()->back()->with('warning','Request Denied Successful'); 
                }
    
        
        }

        // Assign Guest Request
        public function assign_guest_request(GuestRequest $guest_request){
            return view('ADMIN.dashboard.components.guest-requests.assign.create',['guest_request'=>$guest_request]);
        }

        // Assign Guest Request to user
        public function assign_guest_request_to(Request $request ,GuestRequest $guest_request){
            $validated = $request->validate(['user_id'=>['required','numeric']]);
            $user = User::where('id',$validated['user_id'])->first();
            if($user){
                if($guest_request->assigned_to != null){
                    return redirect()->back()->with('warning','Request Already Assigned to someone');
                }else{

                    $guest_request->assigned_to = $user->id;
                    $guest_request->save();
                    return redirect()->back()->with('success','Request Assigned Successfully');
                }
            }
        }

        public function view_assigned_guest_request(User $user){
            return view('ADMIN.dashboard.components.guest-requests.assign.index',['user'=>$user]);
        }

        // Bulk Request Controller
        public function handle_bulk_guest_request_page(){
            return view('ADMIN.dashboard.components.guest-requests.bulk-handle.create');
            
        }

        // Bulk Handle Guests requests
        public function bulk_handle_guests_requests(Request $request){

            if(!($request->input('requests'))){
                return redirect()->back()->with('failure','Select At least one request');
            }

            if($request->input('submit') == "Deny"){
                
                $guest_requests = GuestRequest::whereIn('id',$request->input('requests'))->get();

                // Handle Each separately
                foreach($guest_requests as $request){
                    self::deny_request($request);
                }
                return redirect(route('show_guest_requests'))->with('warning','Requests Denied Successfully');

            }elseif($request->input('submit') == "Grant"){

                $guest_requests = GuestRequest::whereIn('id',$request->input('requests'))->get();

                // Handle Each separately
                foreach($guest_requests as $request){
                    self::grant_request($request);
                }


                return redirect(route('show_guest_requests'))->with('success','Requests Granted Successfully');


            }
            
        }



        // HANDLE REQUEST FUNCTIONN

        // Grant
        public function grant_request(GuestRequest $guest_request){
                // Check if it's an insert method
                if($guest_request->method == 'insert'){
                        $body = json_decode($guest_request->body, true);
                        $body['is_activated'] = 1;
                        $body['created_at'] = now();
                        $body['updated_at'] = now();
                        $body['email_verified_at'] = now();
                        $body['remember_token'] = Str::random(10);
                        // Create New Table Instance
                        $result = DB::table($guest_request->table_name)->{$guest_request->method}($body);
                        if ($result) {
                            // Retrieve the last inserted ID
                            $instance_id = DB::getPdo()->lastInsertId();
                        }
                        // Update the request as one handled/denied
                        $guest_request->handle_method ="granted";
                        $guest_request->is_handled = 1;
                        $guest_request->handled_on = now();
                        $guest_request->handled_by = auth()->user()->id;
                        $guest_request->instance_id = $instance_id;
                        $guest_request->save();

                        
                    
                        // If it's creation of account, the username must not be reserved anymore for that guest
                        $guest = $guest_request->guest();
                        if($guest->username != null){
                            $guest->username = $guest->username."_".now();
                            $guest->email = $guest->email."_".now();
                                
                                // Send Email if It's A User Account Created
                                if($guest_request->table_name == "users"){
                                    //The user below has an error which return Ernest Agyare as the user instead of the actual user.
                                    $user = User::find($instance_id)->first();
                                    // Mail::to($guest_request->guest()->email)->send(new AccountCreated($user));
                                }
                            $guest->save(); 
                        }
                        

                    // Check if it's Update
                }elseif($guest_request->method == 'update'){
                    return "Update the Guy";
                    // Check if it's Delte
                }elseif($guest_request->method == 'delete'){
                    return "Delete The guy Nana";
                }

        }

        // Deny
        public function deny_request(GuestRequest $guest_request){
            $guest_request->handle_method ="denied";
            $guest_request->is_handled = 1;
            $guest_request->handled_on = now();
            $guest_request->handled_by = auth()->user()->id;
            $guest_request->save();
    
            // If it's creation of account, the username must not be reserved anymore for that guest
                $guest = $guest_request->guest();
                    if($guest->username != null){
                        $guest->username = $guest->username."_".now();
                        $guest->email = $guest->email."_".now();
                        $guest->save(); 
                    }   
        }

}
