<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Zone;
use App\Models\Semester;
use App\Models\Residence;
use Illuminate\Http\Request;
use App\Models\UserResidence;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

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
    public function create(Zone $zone)
    {

        return view('housing.zones.components.residences.create',['zone'=>$zone]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_residence = $request->validate([
            'name'=>['required','min:5','max:60'],
            'zone_id'=>['required','numeric'],
            'description'=>['required','min:4'],
        ]);

        $zone = Zone::find($validated_residence['zone_id']);
        if($zone){
            Residence::create($validated_residence);
            return redirect()->back()->with('success','Residence Created Successfully');
        }else{
            return redirect()->back()->with('failure','Select A valid zone');
        }
    
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
        return view('housing.zones.components.residences.edit',['residence'=>$residence]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Residence $residence)
    {
        $validated_residence = $request->validate([
            'name'=>['required','min:5','max:35'],
            'zone_id'=>['required','numeric'],
            'description'=>['required','min:4'],
        ]);

        $zone = Zone::find($validated_residence['zone_id']);
        if($zone){
            $residence->update($validated_residence);
            return redirect()->back()->with('success','Residence Created Successfully');
        }else{
            return redirect()->back()->with('failure','Select A valid zone');
        }

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirm_delete(Residence $residence)
    {
        return view('housing.zones.components.residences.delete',['residence'=>$residence]);
    }

    // Delete
    public function delete(Request $request,Residence $residence){
        $validated = $request->validate([
            'response'=>['required','numeric']
        ]);

        if($validated['response'] == 1){
            $residence->delete();
            return redirect()->back()->with('warning','Residence Deleted Successfully');
        }
    }

    public function create_user_residence(User $user){
        return view('profile.components.members.unknown-residence.create',['user'=>$user]);
    }

    public function store_user_residence(Request $request, User $user){
        $validated = $request->validate([
            'name'=>['required'],
            'category'=>['required'],
            'description'=>['nullable'],
            'zone_id'=>['required'],
        ]);

        $zone = Zone::find($validated['zone_id']);
        if($zone || $validated['zone_id'] == "none"){

            if($zone){
                $zone_id = $validated['zone_id'];
            }else{
                $zone_id = null;
            }


        }else{
            return redirect()->back()->with('failure','Select A Valid Zone');
        }

        $instance['user_id'] = $user->id;
        $instance['name'] = $validated['name'];
        $instance['category'] = $validated['category'];
        $instance['zone_id'] = $zone_id;
        $instance['description'] = $validated['description'];
        $instance['academic_year_id'] = Semester::active_semester()->academicYear->id;
        $instance['created_at'] = now();
        $instance['updated_at'] = now();

        try{

            DB::table('user_residences')->insert($instance);
        }catch (QueryException $e) {
            Log::error($e);
                    
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1062) {
                // Redirect to a custom error page for duplicate entry
                return redirect(route('view_profile',['user'=>$user]))->with('warning', 'You Already Have A Custom Residence.');
            }

        }

        return redirect(route('view_profile',['user'=>$user]))->with('success','You have now completed Your Profile');

    }

    // Edit User REsidence
    public function edit_user_residence(UserResidence $user_residence){
        
        return view('housing.zones.others.residences.edit',['residence'=>$user_residence]);        
    }

    // Confirm Delte User Residence
    public function confirm_delete_user_residence(UserResidence $user_residence){
        return view('housing.zones.others.residences.delete',['residence'=>$user_residence]);        
    }

    // Update User Residence
    public function update_user_residence(Request $request,UserResidence $user_residence){
        $validated = $request->validate([
            'name'=>['required'],
            'zone_id'=>['nullable','numeric'],
            'description'=>['nullable']
        ]);
        if($user_residence){
            $user_residence->name = $validated['name'];
            $user_residence->zone_id = $validated['zone_id'];
            $user_residence->description = $validated['description'];
            $user_residence->save();
            return redirect()->back()->with('success','Update Successful.');
        }else{
            return redirect()->back()->with('failure','Error');
        }
    }

    // Delte User REsidence
    public function delete_user_residence(Request $request,UserResidence $user_residence){
        $validated = $request->validate([
            'response'=>['required','numeric'],
        ]);
        if($user_residence){
            $user_residence->delete();
            return redirect()->back()->with('warning','Delete Successful.');
        }else{
            return redirect()->back()->with('failure','Error');
        }
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

    // Confrim Save User REsidence
    public function confrim_save(UserResidence $user_residence){
        $user = Residence::custom_residence_user($user_residence);
        return view('housing.zones.others.residences.save',['residence'=>$user_residence, 'user'=>$user ]);   
    }

    // Save User REsidence, Making it general and applicable to all
    public function save_user_residence(Request $request, UserResidence $user_residence , $user){
        $user = User::find($user);
        $validated_residence = $request->validate([
            'name'=>['required','min:5','max:60'],
            'zone_id'=>['required','numeric'],
            'description'=>['required','min:4'],
        ]);
        // Create New Residence
        $residence = Residence::create($validated_residence);

        // Update User Biodata
        $user->member_biodata->residence_id = $residence->id;
        $user->member_biodata->zone_id = $residence->zone_id;
        $user->member_biodata->save();

        // Delete User REsidence INstance
        $user_residence->delete();
        
        // Return to appropriate Screen
        return redirect()->back()->with('success','Residence Saved and Created Successfully');


    }


}
