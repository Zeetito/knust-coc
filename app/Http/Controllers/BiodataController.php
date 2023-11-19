<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Zone;
use App\Models\Biodata;
use App\Models\Program;
use App\Models\Semester;
use App\Models\Residence;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class BiodataController extends Controller
{
    // VIEW/SHOW PROFILE
    public function show(User $user)
    {

        // Check whether or not the user is a Member
        if ($user->is_member == 1) {
            // If User is a member, Check if Member is a Student

            if ($user->is_student == 1 && $user->has_member_profile() == true) {
                //  If user is student
                return view('profile.components.members.students.show', ['user' => $user]);

            } elseif ($user->is_student == 0 && $user->has_member_profile() == true) {
                // If user is not. Non student member Like preacher and his family or
                // N.S personelles
                return view('profile.components.members.non-students.show', ['user' => $user]);
            }

        } elseif ($user->is_member == 0 && $user->has_alumini_profile() == true) {
            // if User is not a member (Alumini)
            return view('profile.components.alumini.show', ['user' => $user]);
        }

        return redirect(route('create_user_profile_form', ['user' => $user]));

    }

    // CREATING PROFILE
    public function create(User $user)
    {
        // Check whether or not the user is a Member
        if ($user->is_member == 1) {
            // If User is a member, Check if Member is a Student

            if ($user->is_student == 1) {
                //  If user is student
                return view('profile.components.members.students.create', ['user' => $user]);
            } else {
                // If user is not. Non student member Like preacher and his family or
                // N.S personelles
                return view('profile.components.members.non-students.create', ['user' => $user]);
            }
        } else {
            // if User is not a member (Alumini)
            return view('profile.components.alumini.create', ['user' => $user]);
        }
        // return view('profile.create',['user'=>$user ,'programs'=>'', 'residences'=>'']);
    }

    // STORE BIODATA
    public function store(User $user, Request $request)
    {
        // Check whether the user is member, student or alumini
        if ($user->is_member == 1) {
            // If User is a member, Check if Member is a Student

            if ($user->is_student == 1 && $user->has_member_profile() == false) {
                //  If user is student and does not have a student profile already

                // Validate the input
                $validated = $request->validate([
                    'room' => ['required'],
                    'year' => ['required'],
                    'residence_id' => ['required'],
                    'program_id' => ['required'],
                    'college_id' => ['nullable'],
                ]);
                $program = Program::findProgramByName($validated['program_id']);
                    $residence = Residence::findResidenceByName($validated['residence_id']);
                
                    if (!$program || !$residence) {
                        // Handle the case where either program or residence is null
                        return redirect()->back()->with('failure', 'Make sure to  Select the Program / Residence from the List Provided');
                    }
                
                    $program_id = $program->id;
                    $college_id = $program->college->id;
                    $residence_id = $residence->id;
                    $zone_id = $residence->zone->id;

                $validated['residence_id'] = $residence_id;
                $validated['zone_id'] = $zone_id;
                $validated['program_id'] = $program_id;
                $validated['college_id'] = $college_id;

                // Create the Student Profile Now
                DB::table('members_biodatas')->insert([
                    'user_id' => $user->id,
                    'year' => $validated['year'],
                    'program_id' => $validated['program_id'],
                    'college_id' => $validated['college_id'],
                    'residence_id' => $validated['residence_id'],
                    'zone_id' => $validated['zone_id'],
                    'room' => $validated['room'],
                    'academic_year_id' => Semester::active_semester()->academicYear->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return redirect(route('view_profile', ['user' => $user]))->with('success', 'Profile Created Successfully');

            } elseif ($user->is_student == 0 && $user->has_member_profile() == false) {
                // If user is not. Non student member Like preacher and his family or N.S personelles
                $validated = $request->validate([
                    'room' => ['nullable'],
                    'ns_status' => ['required', 'numeric'],
                    'is_alumini' => ['required', 'numeric'],
                    'residence_id' => ['nullable'],
                    'zone_id' => ['nullable'],
                    'year_group_id' => ['nullable'],
                ]);

                // If User is not an alumini, no need to
                // get year group id even if it was selected
                if ($validated['is_alumini'] == 0) {
                    $validated['year_group_id'] = null;

                }

                // If the resdidence is null, that's when we need the zone_id from the form
                $residence = Residence::findResidenceByName($validated['residence_id']);



                if (!$residence) {
                    // Handle the case where either program or residence is null
                    return redirect()->back()->with('failure', 'Make sure to  Select the Residence from the List Provided');
                }
                    //   If the residence is not null, we use it and query the zone from it
                    $validated['residence_id'] = $residence->id;
                    $validated['zone_id'] = $residence->zone->id;

                //    Now Insert the validated into the members biodatas table.
                DB::table('members_biodatas')->insert([
                    'user_id' => $user->id,
                    'residence_id' => $validated['residence_id'],
                    'room' => $validated['room'],
                    'ns_status' => $validated['ns_status'],
                    'is_alumini' => $validated['is_alumini'],
                    'year_group_id' => $validated['year_group_id'],
                    'academic_year_id' => Semester::active_semester()->academicYear->id,
                    'created_at' => now(),
                    'updated_at' => now(),

                ]);

                return redirect(route('view_profile', ['user' => $user]))->with('success', 'Profile Created Successfully');

            }

            // if User is not a member (Alumini)
        } elseif ($user->is_member == 0 && $user->has_alumini_profile() == false) {
            $validated = $request->validate([
                'country' => ['required'],
                'state' => ['required'],
                'city' => ['required'],
                'local_congregation' => ['required'],
                'year_group_id' => ['required'],
            ]);
            $validated['user_id'] = $user->id;

            //    Now Insert the validated into the members biodatas table.
            DB::table('alumini_biodatas')->insert([
                'user_id' => $user->id,
                'country' => $validated['country'],
                'state' => $validated['state'],
                'city' => $validated['city'],
                'local_congregation' => $validated['local_congregation'],
                'year_group_id' => $validated['year_group_id'],
                'academic_year_id' => Semester::active_semester()->academicYear->id,
                'created_at' => now(),
                'updated_at' => now(),

            ]);

            return redirect(route('view_profile', ['user' => $user]))->with('success', 'Profile Created Successfully');

        }

        // After Everything
        return redirect(back())->with('failure', 'Already has a profile');

    }

    // EDIT FORM FOR BIODATA
    public function edit(User $user)
    {
        // Check whether or not the user is a Member
        if ($user->is_member == 1) {
            // If User is a member, Check if Member is a Student

            if ($user->is_student == 1 && $user->has_member_profile() == true) {
                //  If user is student
                return view('profile.components.members.students.edit', ['user' => $user]);

            } elseif ($user->is_student == 0 && $user->has_member_profile() == true) {
                // If user is not. Non student member Like preacher and his family or
                // N.S personelles
                return view('profile.components.members.non-students.edit', ['user' => $user]);
            }

        } elseif ($user->is_member == 0 && $user->has_alumini_profile() == true) {
            // if User is not a member (Alumini)
            return view('profile.components.alumini.edit', ['user' => $user]);
        }

        return redirect(route('create_user_profile_form', ['user' => $user]));

    }

    // UPDATE BIODATA
    public function update(Request $request, User $user)
    {
        //
        // Check whether or not the user is a Member
        if ($user->is_member == 1) {
            // If User is a member, Check if Member is a Student

            if ($user->is_student == 1 && $user->has_member_profile() == true) {
                //  If user is student
                

                $validated = $request->validate([
                    'room' => ['required'],
                    'year' => ['nullable'],
                    'residence_id' => ['required'],
                    'zone_id' => ['nullable'],
                    'program_id' => ['required'],
                    'college_id' => ['nullable'],
                ]);

           
                    $program = Program::findProgramByName($validated['program_id']);
                    $residence = Residence::findResidenceByName($validated['residence_id']);
                
                    if (!$program || !$residence) {
                        // Handle the case where either program or residence is null
                        return redirect()->back()->with('failure', 'Make sure to  Select the Program / Residence from the List Provided');
                    }
                
                    $program_id = $program->id;
                    $college_id = $program->college->id;
                    $residence_id = $residence->id;
                    $zone_id = $residence->zone->id;
              

                    $validated['user_id'] = $user->id;
                    $validated['residence_id'] = $residence_id;
                    $validated['zone_id'] = $zone_id;
                    $validated['program_id'] = $program_id;
                    $validated['college_id'] = $college_id;
                    $validated['updated_at'] = now();
                    $validated['created_at'] = $user->biodata->created_at;
                    $validated['academic_year_id'] = Semester::active_semester()->academicYear->id;
                    

                    if ($validated['year'] == null) {
                        $validated['year'] = $user->year();
                    }
                    // If the Current User is a Ministry Member/ Leader, update right away
                    if(Auth()->user()->hasAnyOf(Role::ministry_members_level()->get())){

                        // Check if the last update has been at least two months if so, create a new biodata else, update the existing one
                        if (now()->diffInDays($user->biodata->updated_at) >= 60) {
                            DB::table('members_biodatas')->insertOrIgnore($validated);
                            return redirect()->back()->with('success', 'Biodata Updated Successfully');

                            // If the latest update is less than 60 days, update the latest one
                        } else {
                            $latest_biodata_id = $user->biodata->id;
                            DB::table('members_biodatas')->where('id', $latest_biodata_id)->update($validated);

                            return redirect()->back()->with('success', 'Biodata Updated Successfully');
                        }

                    // Else Create Request to be Granted later
                    }else{
                            // Try and Catch Error
                            try {
                                // Your code that saves data to the database
                                $update_request = new UserRequest;
                                $update_request['user_id'] = $user->id;
                                $update_request['body'] = json_encode($validated); 
                                $update_request['table_name'] = "members_biodatas"; 

                                if(now()->diffInDays($user->biodata->updated_at) >= 60) {
                                $update_request['method'] = "create";
                                }else{
                                $update_request['method'] = "update";
                                $update_request['instance_id'] = $user->biodata->id;
                                }
                                $update_request['type'] = "Biodata";
                                
                                $update_request['academic_year_id'] = Semester::active_semester()->academicYear->id;
                                $update_request->save();
        
                            } catch (QueryException $e) {
                                Log::error($e);
                            
                                $errorCode = $e->errorInfo[1];
                            
                                // Check if the error code corresponds to a unique constraint violation
                                if ($errorCode == 1062) {
                                    // Redirect to a custom error page for duplicate entry
                                    return redirect()->back()->with('warning', 'Your Previous Update is being processed');
                                }
                            
                                // If it's not a unique constraint violation, you can handle other database-related errors here
                                // ...
                            
                                // Re-throw the exception if it's not a unique constraint violation
                                throw $e;
                            }

                      
                        return redirect()->back()->with('success','Done! Changes may reflect soon');
                    }
                // NON STUDENT MEMBER
            } elseif ($user->is_student == 0 && $user->has_member_profile() == true) {
                // If user is not. Non student member Like preacher and his family or
                // N.S personelles
                // Check if the last update has been at least two months if so, create a new biodata else, update the existing one

                $validated = $request->validate([
                    'room' => ['nullable'],
                    'ns_status' => ['required', 'numeric'],
                    'is_alumini' => ['required', 'numeric'],
                    'residence_id' => ['nullable'],
                    'zone_id' => ['nullable'],
                    'year_group_id' => ['nullable'],

                ]);
                $validated['updated_at'] = now();
                $validated['created_at'] = $user->biodata->created_at;
                $validated['academic_year_id'] = Semester::active_semester()->academicYear->id;
                $validated['user_id'] = $user->id;

                if ($validated['is_alumini'] == 0) {
                    $validated['year_group_id'] = null;
                   
                }

                // If the resdidence is null, that's when we need the zone_id from the form
                $residence = Residence::findResidenceByName($validated['residence_id']);
                if ($residence == null) {
                    $validated['residence_id'] = null;
                } else {
                    //   If the residence is not null, we use it and query the zone from it
                    $validated['residence_id'] = $residence->id;
                    $validated['zone_id'] = $residence->zone->id;
                }

                
                // Check if the current user is a ministry Member or leader
                if(Auth()->user()->hasAnyOf(Role::ministry_members_level()->get())){

                    if (now()->diffInDays($user->biodata->updated_at) >= 60) {
                        DB::table('members_biodatas')->insertOrIgnore($validated);
                        return redirect()->back()->with('success', 'Biodata Updated Successfully');
                    } else {
                        $latest_biodata_id = $user->biodata->id;
                        DB::table('members_biodatas')->where('id', $latest_biodata_id)->update($validated);

                        return redirect()->back()->with('success', 'Biodata Updated Successfully');
                    }
                }else{

                    try {
                        // Your code that saves data to the database
                        $update_request = new UserRequest;
                        $update_request['user_id'] = $user->id;
                        $update_request['body'] = json_encode($validated); 
                        $update_request['table_name'] = "members_biodatas"; 
                        $update_request['method'] = "update";
                        $update_request['type'] = "Biodata";
                        $update_request['instance_id'] = $user->biodata->id;
                        $update_request['academic_year_id'] = Semester::active_semester()->academicYear->id;
                        $update_request->save();

                    } catch (QueryException $e) {
                        Log::error($e);
                    
                        $errorCode = $e->errorInfo[1];
                    
                        // Check if the error code corresponds to a unique constraint violation
                        if ($errorCode == 1062) {
                            // Redirect to a custom error page for duplicate entry
                            return redirect()->back()->with('warning', 'Your Previous Update is being processed');
                        }
                    
                        // If it's not a unique constraint violation, you can handle other database-related errors here
                        // ...
                    
                        // Re-throw the exception if it's not a unique constraint violation
                        throw $e;
                    }

              
                return redirect()->back()->with('success','Done! Changes may reflect soon');

                }

            }

        } elseif ($user->is_member == 0 && $user->has_alumini_profile() == true) {
                // if User is not a member (Alumini)
                $validated = $request->validate([
                    'country' => ['required'],
                    'state' => ['required'],
                    'city' => ['required'],
                    'local_congregation' => ['required'],
                    'year_group_id' => ['required'],
                ]);
                $validated['user_id'] = $user->id;
                $validated['updated_at'] = now();
                $validated['created_at'] = $user->biodata->created_at;
                $validated['academic_year_id'] = Semester::active_semester()->academicYear->id;

            // If the Current User is a Ministry Member/ Leader, update right away
            if(Auth()->user()->hasAnyOf(Role::ministry_members_level()->get())){

                if (now()->diffInDays($user->biodata->updated_at) >= 60) {
                    DB::table('alumini_biodatas')->insertOrIgnore($validated);
                    return redirect()->back()->with('success', 'Biodata Updated Successfully');
                } else {
                    $latest_biodata_id = $user->biodata->id;
                    DB::table('alumini_biodatas')->where('id', $latest_biodata_id)->update($validated);
                    return redirect()->back()->with('success', 'Biodata Updated Successfully');
                }
                // Else Create Request to be Granted later
            }else{
                 // Try and Catch Error
                 try {
                    // Your code that saves data to the database
                    $update_request = new UserRequest;
                    $update_request['user_id'] = $user->id;
                    $update_request['body'] = json_encode($validated); 
                    $update_request['table_name'] = "alumini_biodatas"; 
                    $update_request['method'] = "update";
                    $update_request['type'] = "Biodata";
                    $update_request['instance_id'] = $user->biodata->id;
                    $update_request['academic_year_id'] = Semester::active_semester()->academicYear->id;
                    $update_request->save();

                } catch (QueryException $e) {
                    Log::error($e);
                
                    $errorCode = $e->errorInfo[1];
                
                    // Check if the error code corresponds to a unique constraint violation
                    if ($errorCode == 1062) {
                        // Redirect to a custom error page for duplicate entry
                        return redirect()->back()->with('warning', 'Your Previous Update is being processed');
                    }
                
                    // If it's not a unique constraint violation, you can handle other database-related errors here
                    // ...
                
                    // Re-throw the exception if it's not a unique constraint violation
                    throw $e;
                }

          
            return redirect()->back()->with('success','Done! Changes may reflect soon');
            }

        }

        return redirect(route('create_user_profile_form',['user'=>$user]))->with('warning','Please Update Your Profile');

    }

    // DELETE PROFIEL
    public function destroy(Biodata $biodata)
    {
        //
    }

    // MODALS VIEWW
    // some users do not have biodata due to seeding
    public function show_modal_info(User $user)
    {

        return view('modals.user.user-info', ['profile' => $user->biodata]);
    }

    // SEARCHES
    // Search Programs
    public function profile_search_programs(Request $request)
    {

        $string = $request->input('str');
        $str = '%'.$string.'%';

        // If the String is not empty
        if (! empty($string)) {

            $programs = Program::where('name', 'like', $str)->get();

        } else {

            $programs = '';

        }

        return view('profile.components.programs.search-results', ['programs' => $programs]);

    }

    // Search Residences
    public function profile_search_residences(Request $request)
    {

        $string = $request->input('str');
        $str = '%'.$string.'%';

        // If the String is not empty
        if (! empty($string)) {

            $residences = Residence::where('name', 'like', $str)->get();

        } else {

            $residences = '';

        }

        return view('profile.components.residences.search-results', ['residences' => $residences]);

    }
}

// public function store(User $user, Request $request)
// {
//     //
//     $validated = $request->validate([
//         'room' => ['required'],
//         'year' => ['required'],
//         'residence_id' => ['required'],
//         'program_id' => ['required'],
//         'college_id'=>['nullable'],
//     ]);
//     $program_id =  Program::findProgramByName($validated['program_id'])->id;
//     $college_id =  Program::findProgramByName($validated['program_id'])->college->id;

//     $validated['user_id'] = $user->id;
//     $validated['residence_id'] = Residence::findResidenceByName($validated['residence_id'])->id;
//     $validated['program_id'] = $program_id;
//     $validated['college_id'] = $college_id;

//     // $validated['college_id'] = Program::find($validated['program_id'])->college()->id;

//     Biodata::create($validated);
//     return redirect(route('view_profile',$user))->with('success','Profile Created Successfully');
// }
