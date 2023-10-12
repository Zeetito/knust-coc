<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Zone;
use App\Models\Biodata;
use App\Models\Program;
use App\Models\Residence;
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
    public function create(User $user)
    {
        //
        // $zones = Zone::all();
        return view('profile.create',['user'=>$user ,'programs'=>'', 'residences'=>'']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user, Request $request)
    {
        //
        $validated = $request->validate([
            'room' => ['required'],
            'year' => ['required'],
            'residence_id' => ['required'],
            'program_id' => ['required'],
            'college_id'=>'',
        ]);
        $validated['user_id'] = $user->id;
        $validated['residence_id'] = Residence::findResidenceByName($validated['residence_id'])->id;
        $validated['college_id'] = Program::findProgramByName($validated['program_id'])->college->id;
        $validated['program_id'] = Program::findProgramByName($validated['program_id'])->id;

        // return $user;
        // Program id is used to query for the college id.
        // $validated['college_id'] = Program::find($validated['program_id'])->college()->id;

        Biodata::create($validated);
        return redirect(route('view_profile',$user))->with('success','Profile Created Successfully');
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
        return view('profile.edit',['profile' => $profile ,'programs'=>'' , 'residences'=>'', 'user' => $user]);
        
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
            'program_id' => ['required'] ,
            'residence_id' => ['required'] ,
            'college_id' => [''] ,
        ]);

        $validated['college_id'] = Program::findProgramByName($validated['program_id'])->college->id;
        $validated['program_id'] = Program::findProgramByName($validated['program_id'])->id;
        $validated['residence_id'] = Residence::findResidenceByName($validated['residence_id'])->id;

       

      
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


    // search programs 
    public function profile_search_programs(Request $request){

        $string =  $request->input('str');
        $str = "%".$string."%";

            // If the String is not empty
            if(!empty($string)){
              
            $programs = Program::where('name','like',$str)->get();

            }else{

            $programs = '';
                
            }

            return view('profile.components.programs.search-results',['programs'=>$programs]);        

    }

    // search residences 
    public function profile_search_residences(Request $request){

        $string =  $request->input('str');
        $str = "%".$string."%";

            // If the String is not empty
            if(!empty($string)){
              
            $residences = Residence::where('name','like',$str)->get();

            }else{

            $residences = '';
                
            }

            return view('profile.components.residences.search-results',['residences'=>$residences]);        

    }


}
