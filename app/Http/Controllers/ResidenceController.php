<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Semester;
use App\Models\Residence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResidenceController extends Controller
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Residence $residence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Residence $residence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Residence $residence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Residence $residence)
    {
        //
    }

    public function create_user_residence(User $user){
        return view('profile.components.members.unknown-residence.create',['user'=>$user]);
    }

    public function store_user_residence(Request $request, User $user){
        $validated = $request->validate([
            'name'=>['required'],
            'category'=>['required'],
            'description'=>['nullable']
        ]);

        $instance['user_id'] = $user->id;
        $instance['name'] = $validated['name'];
        $instance['category'] = $validated['category'];
        $instance['description'] = $validated['description'];
        $instance['academic_year_id'] = Semester::active_semester()->academicYear->id;
        $instance['created_at'] = now();
        $instance['updated_at'] = now();


        DB::table('user_residences')->insert($instance);

        return redirect(route('view_profile',['user'=>$user]))->with('success','You have now completed Your Profile');

    }

    // update_biodata_residence
    public function  update_biodata_residence(Request $request, User $user){

        $validated =  $request->validate([
            'residence_id' => ['required'],
            'room' => ['required'],
        ]);

        $residence = Residence::findResidenceByName($validated['residence_id']);
                
        if (!$residence) {
            // Handle the case where either program or residence is null
            return redirect()->back()->with('failure', 'Make sure to  Select the Residence from the List Provided');
        }
        
        $update['residence_id'] = $residence->id;
        $update['zone_id'] = $residence->zone->id;
        $update['room'] = $validated['room'];

        $user->biodata->update($update);

        return redirect(route('view_profile',['user'=>$user]))->with('success','You have now completed Your Profile');

    }


}
