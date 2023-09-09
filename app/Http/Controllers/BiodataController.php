<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Zone;
use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $zones = Zone::all();
        return view('profile.create',['user'=>$user , 'profile'=>$profile]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'room' => ['required'],
            'year' => ['required'],
        ]);
        $validated['user_id'] = Auth::user()->id;
        $validated['zone_id'] = 1;
        $validated['residence_id'] = 1;
        // $validated['room'] = "1A";
        $validated['program_id'] = "16";

        // Program id is used to query for the college id.
        // $validated['college_id'] = Program::find($validated['program_id'])->college()->id;

        $biodata = Biodata::create($validated);
        return redirect(route('view_profile',auth()->user()))->with('success','Profile Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        $profile = $user->biodata;
        return view('profile.show',['profile' => $profile , 'user' => $user]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        $profile = $user->biodata;
        $zones = Zone::all();
        return view('profile.edit',['profile' => $profile , 'zones'=>$zones, 'user' => $user]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Biodata $biodata)
    {
        //
        $validated = $request->validate([
            'room' => ['min:2'] ,
            // 'room' => ['alpha_num:ascii'] ,
            'zone_id' => ['numeric'] ,
        ]);

      
        try {
            // Attempt to update the Biodata model
            $biodata->update($validated);
            // Redirect to the 'view_profile' route with a success message
            return redirect(route('view_profile', $biodata->user_id))->with('success', 'Biodata updated successfully');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during the update
            // You can log the error or return an error message
            return back()->with('failure', 'An error occurred while updating the biodata');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Biodata $biodata)
    {
        //
    }


    // MODALS VIEWW
    // some users do not have biodata due to seeding
    public function show_modal_info(User $user){

        return view('modals.user.user-info',['profile'=>$user->biodata]);
    }

}
