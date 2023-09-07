<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        return view('profile.edit',['profile' => $profile , 'user' => $user]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Biodata $biodata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Biodata $biodata)
    {
        //
    }
}
