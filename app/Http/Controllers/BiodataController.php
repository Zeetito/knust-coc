<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Program;
use App\Models\Residence;
use App\Models\Semester;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                $program_id = Program::findProgramByName($validated['program_id'])->id;
                $college_id = Program::findProgramByName($validated['program_id'])->college->id;
                $residence_id = Residence::findResidenceByName($validated['residence_id'])->id;
                $zone_id = Residence::findResidenceByName($validated['residence_id'])->zone->id;

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
                if ($residence == null) {
                    $validated['residence_id'] = null;
                } else {
                    //   If the residence is not null, we use it and query the zone from it
                    $validated['residence_id'] = $residence->id;
                    $validated['zone_id'] = $residence->zone->id;
                }

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
                $program_id = Program::findProgramByName($validated['program_id'])->id;
                $college_id = Program::findProgramByName($validated['program_id'])->college->id;
                $residence_id = Residence::findResidenceByName($validated['residence_id'])->id;
                $zone_id = Residence::findResidenceByName($validated['residence_id'])->zone->id;

                $validated['residence_id'] = $residence_id;
                $validated['zone_id'] = $zone_id;
                $validated['program_id'] = $program_id;
                $validated['college_id'] = $college_id;
                $validated['updated_at'] = now();

                if ($validated['year'] == null) {
                    $validated['year'] = $user->year();
                }

                // return now()->diffInDays($user->biodata()->updated_at);
                // Check if the last update has been at least two months if so, create a new biodata else, update the existing one
                if (now()->diffInDays($user->biodata()->updated_at) >= 60) {

                    DB::table('members_biodatas')->insertOrIgnore([
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

                    return redirect()->back()->with('success', 'Biodata Updated Successfully');
                } else {
                    $latest_biodata_id = $user->biodata()->id;
                    DB::table('members_biodatas')->where('id', $latest_biodata_id)->update($validated);

                    return redirect()->back()->with('success', 'Biodata Updated Successfully');
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
                if ($validated['is_alumini'] == 0) {
                    $validated['year_group_id'] = null;
                    $validated['updated_at'] = now();
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

                if (now()->diffInDays($user->biodata()->updated_at) >= 60) {

                    DB::table('members_biodatas')->insertOrIgnore([
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

                    return redirect()->back()->with('success', 'Biodata Updated Successfully');
                } else {
                    $latest_biodata_id = $user->biodata()->id;
                    DB::table('members_biodatas')->where('id', $latest_biodata_id)->update($validated);

                    return redirect()->back()->with('success', 'Biodata Updated Successfully');
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

            if (now()->diffInDays($user->biodata()->updated_at) >= 60) {
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

                return redirect()->back()->with('success', 'Biodata Updated Successfully');
            } else {
                $latest_biodata_id = $user->biodata()->id;
                DB::table('alumini_biodatas')->where('id', $latest_biodata_id)->update($validated);

                return redirect()->back()->with('success', 'Biodata Updated Successfully');
            }
        }

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
