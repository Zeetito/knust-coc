<?php

namespace App\Http\Controllers\admin;

use App\Models\Guest;
use Illuminate\Support\Str;
use App\Models\GuestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GuestController extends Controller
{
    //

    // GUEST REQUESTS
    // View All Guest Request
    public function show_guest_requests(){
        return view('ADMIN.dashboard.components.guest-requests.index');
    }

    // Search Guest request
    public function search_guest_requests(Request $request)
    {
        $guests = Guest::search_guest($request)->get()->pluck('id');
        $requests = GuestRequest::where('is_handled',0)
                ->whereIn('guest_id',$guests)
                ->get()
                ;
        return view('ADMIN.dashboard.components.guest-requests.search-results', ['requests' => $requests]);
    }

     // Filter Guest requests
    public function filter_guest_requests(Request $request)
    {
        // Check the string value of the request
        $string = $request->input('str');
        if ($string == 'fresher' || $string == 'member') {
            $guests_id = Guest::where('status',"$string")->pluck('id');
            $requests = Guest::guest_requests()->whereIn('guest_id',$guests_id)
                ->get()
                ;
                
            
            // If the String is empty
        } elseif (! empty($string)) {
            $requests = Guest::guest_requests()
                ->get()
                ;
        }
        // Check for other filters like latest, oldest and thigns
        return view('ADMIN.dashboard.components.guest-requests.search-results', ['requests' => $requests]);
    }
    
    // Edit Guest Request - Modal
    public function edit_guest_request(GuestRequest $guest_request){
        return view('ADMIN.dashboard.components.guest-requests.edit', ['guest_request' => $guest_request]);
    }

    // Handle Guest Request - Deny or Grant
    public function handle_guest_request(GuestRequest $guest_request, Request $request){
        $validated = $request->validate([
            'action' => ['required']
        ]);
        
            if($validated['action'] == 'grant'){
                // Check if it's an insert method
                if($guest_request->method == 'insert'){
                        $body = json_decode($guest_request->body, true);
                        $body['is_activated'] = 1;
                        $body['created_at'] = now();
                        $body['updated_at'] = now();
                        $body['email_verified_at'] = now();
                        $body['remember_token'] = Str::random(10);
                        // Create New Table Instance
                        $instance = DB::table($guest_request->table_name)->{$guest_request->method}($body);
                        // Update the request as one handled/denied
                        $guest_request->handle_method ="granted";
                        $guest_request->is_handled = 1;
                        $guest_request->handled_on = now();
                        $guest_request->handled_by = auth()->user()->id;
                        $guest_request->instance_id = $instance->id;
                        $guest_request->save();

                        // If it's creation of account, the username must not be reserved anymore for that guest
                        $guest = $guest_request->guest();
                        if($guest->username != null){
                            $guest->username = $guest->username."_".now();
                            $guest->email = $guest->email."_".now();
                            $guest->save(); 
                        }
                        
                        return redirect()->back()->with('success','Grant Success');  

                    // Check if it's Update
                }elseif($guest_request->method == 'update'){
                    return "Update the Guy";
                    // Check if it's Delte
                }elseif($guest_request->method == 'delete'){
                    return "Delete The guy Nana";
                }

            }else{
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

                    return redirect()->back()->with('warning','Request Denied Successful'); 
            }

    
    }



}
