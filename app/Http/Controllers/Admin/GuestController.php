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
    




}
