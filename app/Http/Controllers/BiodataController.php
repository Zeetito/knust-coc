<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Zone;
use App\Models\Biodata;
use App\Models\Contact;
use App\Models\Program;
use App\Models\Semester;
use App\Models\Residence;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use App\Models\MembersBiodata;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\BiodataResource;
use App\Http\Resources\ContactResource;
use Illuminate\Database\QueryException;

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

        } elseif ($user->is_member == 0 && $user->has_alumni_profile() == true) {
            // if User is not a member (Alumni)
            return view('profile.components.alumni.show', ['user' => $user]);
        }

        if(auth()->user()->is($user)){
            return redirect(route('create_user_profile_form', ['user' => $user]));
        }else{
            return redirect()->back()->with('warning','This User has no profile');
        }

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
            // if User is not a member (Alumni)
            return view('profile.components.alumni.create', ['user' => $user]);
        }
        // return view('profile.create',['user'=>$user ,'programs'=>'', 'residences'=>'']);
    }

    // STORE BIODATA
    public function store(User $user, Request $request)
    {
        // return $request;
        // Check whether the user is member, student or alumni
        if ($user->is_member == 1) {
            // If User is a member, Check if Member is a Student

            if ($user->is_student == 1 && $user->has_member_profile() == false) {
                //  If user is student and does not have a student profile already

                // Validate the input

                $validated = $request->validate([
                    'room' => ['nullable'],
                    'year' => ['required'],
                    'residence_id' => ['required'],
                    'program_id' => ['required'],
                    'college_id' => ['nullable'],
                    'phone' => ['required'],
                    'whatsapp' => ['nullable'],
                    'school_voda' => ['nullable'],
                    'other_contact' => ['nullable'],
                    'guardian_a' => ['required'],
                    'relation_a' => ['required'],
                    'guardian_b' => ['nullable'],
                    'relation_b' => ['nullable'],
                ]);


                $program = Program::findProgramByName($validated['program_id']);
                    $residence = Residence::findResidenceByName($validated['residence_id']);
                
                    if (!$program) {

                        if($validated['program_id'] == 'unknown'){
                            $validated['program_id'] = NULL;
                            $validated['college_id'] = NULL;
                        }else{
                            // if not, He simply typed in some wrong thing
                            return redirect()->back()->with('failure', 'Make sure to  Select the program from the List Provided');
                        }
                    }else{
                        $program_id = $program->id;
                        $college_id = $program->college->id;
                        $validated['program_id'] = $program_id;
                        $validated['college_id'] = $college_id;
                        
                    }

                    if (!$residence){
                        // Check if user claims not to find hostel or comes from home
                        if($validated['residence_id'] == 'unknown'){
                            $validated['residence_id'] = NULL;
                            $validated['zone_id'] = NULL;
                        }else{
                            // if not, He simply typed in some wrong thing
                            return redirect()->back()->with('failure', 'Make sure to  Select the Residence from the List Provided');
                        }

                    }else{
                        // Required room If Residence exists
                        $residence_id = $residence->id;
                        $room_validate = $request->validate(['room'=>['required']]);
                        $zone_id = $residence->zone->id;
                        $validated['residence_id'] = $residence_id;
                        $validated['zone_id'] = $zone_id;
                        
                    }

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
                    'created_at' => now()->format('Y-m-d H:i:s'),
                    'updated_at' => now()->format('Y-m-d H:i:s'),
                ]);

            } elseif ($user->is_student == 0 && $user->has_member_profile() == false) {
                // If user is not. Non student member Like preacher and his family or N.S personelles
                $validated = $request->validate([
                    'room' => ['nullable'],
                    'ns_status' => ['required', 'numeric'],
                    'is_alumni' => ['required', 'numeric'],
                    'residence_id' => ['required'],

                    'year_group_id' => ['nullable'],

                    'phone'=>['required'],
                    'whatsapp'=>['nullable'],
                    'school_voda'=>['nullable'],
                    'other_contact'=>['nullable'],
                    'guardian_a'=>['nullable'],
                    'relation_a'=>['nullable'],
                    'guardian_b'=>['nullable'],
                    'relation_b'=>['nullable'],
                ]);

                // If User is not an alumni, no need to
                // get year group id even if it was selected
                if ($validated['is_alumni'] == 0) {
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
                    'zone_id' => $validated['zone_id'],
                    'room' => $validated['room'],
                    'ns_status' => $validated['ns_status'],
                    'is_alumni' => $validated['is_alumni'],
                    'year_group_id' => $validated['year_group_id'],
                    'academic_year_id' => Semester::active_semester()->academicYear->id,
                    'created_at' => now()->format('Y-m-d H:i:s'),
                    'updated_at' => now()->format('Y-m-d H:i:s'),

                ]);

            }

            // if User is not a member (Alumni)
        } elseif ($user->is_member == 0 && $user->has_alumni_profile() == false) {
            $validated = $request->validate([
                'country' => ['required'],
                'state' => ['required'],
                'city' => ['required'],
                'local_congregation' => ['required'],
                'year_group_id' => ['required'],
                'phone'=>['required'],
                'whatsapp'=>['nullable'],
                'school_voda'=>['nullable'],
                'other_contact'=>['nullable'],
                'guardian_a'=>['nullable'],
                'relation_a'=>['nullable'],
                'guardian_b'=>['nullable'],
                'relation_b'=>['nullable'],
            ]);
            $validated['user_id'] = $user->id;

            //    Now Insert the validated into the members biodatas table.
            DB::table('alumni_biodatas')->insert([
                'user_id' => $user->id,
                'country' => $validated['country'],
                'state' => $validated['state'],
                'city' => $validated['city'],
                'local_congregation' => $validated['local_congregation'],
                'year_group_id' => $validated['year_group_id'],
                'academic_year_id' => Semester::active_semester()->academicYear->id,
                'created_at' => now()->format('Y-m-d H:i:s'),
                'updated_at' => now()->format('Y-m-d H:i:s'),

            ]);

        }

          // Create Contacts For this user
                // Main Phone
                
                if(!$user->phone){
                    $phone =  new Contact;
                        $phone->user_id = $user->id;
                        $phone->body = $validated['phone'];
                        $phone->type = "phone";
                        $phone->is_main = 1;
                        $phone->is_visible = 1;
                    $phone->save();
                    }
    
                    // WhatsApp Contact
                    if(!$user->whatsapp){
                    $whatsapp =  new Contact;
                        $whatsapp->user_id = $user->id;
                        $whatsapp->body = $validated['whatsapp'];
                        $whatsapp->type = "whatsapp";
                        $whatsapp->is_main = 0;
                        $whatsapp->is_visible = 1;
                    $whatsapp->save();
                    }
    
                    // If School Voda Exists, Save it as well
                    if($validated['school_voda'] != null){
                        if(!$user->school_voda){
                        $school_voda =  new Contact;
                            $school_voda->user_id = $user->id;
                            $school_voda->body = $validated['school_voda'];
                            $school_voda->type = "school_voda";
                            $school_voda->is_main = 0;
                            $school_voda->is_visible = 1;
                        $school_voda->save();
                        }
                    }
    
                    // If other contact exists, do same as well
                    if($validated['other_contact'] != null){
                        if(!$user->other_contact){
                        $other_contact =  new Contact;
                            $other_contact->user_id = $user->id;
                            $other_contact->body = $validated['other_contact'];
                            $other_contact->type = "other_contact";
                            $other_contact->is_main = 0;
                            $other_contact->is_visible = 1;
                        $other_contact->save();
                        }
                    }
    
                    // Guardian A Contact
                    if($validated['guardian_a'] != null){
                        if(!$user->main_guardian_contact){
                        $guardian_a =  new Contact;
                            $guardian_a->user_id = $user->id;
                            $guardian_a->body = $validated['guardian_a'];
                            $guardian_a->type = "guardian";
                            $guardian_a->ownership = "guardian";
                            $guardian_a->relation = $validated['relation_a'];
                            $guardian_a->is_main = 1;
                            $guardian_a->is_visible = 0;
                        $guardian_a->save();
                        }
                    }
    
                    // Guardian B Contact
                    if($validated['guardian_b'] != null){
                        if(!$user->other_guardian_contact){
                        $guardian_b =  new Contact;
                            $guardian_b->user_id = $user->id;
                            $guardian_b->body = $validated['guardian_b'];
                            $guardian_b->type = "guardian";
                            $guardian_a->ownership = "guardian";
                            $guardian_a->relation = $validated['relation_b'];
                            $guardian_b->is_main = 0;
                            $guardian_b->is_visible = 0;
                        $guardian_b->save();
                        }
                    }
    
                    if(!$user->email){
                    $email =  new Contact;
                        $email->user_id = $user->id;
                        $email->body = $user->email;
                        $email->type = "email";
                        $email->is_main = 0;
                        $email->is_visible = 1;
                    $email->save();
                    }
    

            return redirect(route('view_profile', ['user' => $user]))->with('success', 'Profile Created Successfully');

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

        } elseif ($user->is_member == 0 && $user->has_alumni_profile() == true) {
            // if User is not a member (Alumni)
            return view('profile.components.alumni.edit', ['user' => $user]);
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
                

                $validated_profile = $request->validate([
                    'room' => ['required'],
                    'year' => ['required'],
                    'residence_id' => ['required'],
                    'program_id' => ['required'],
                    'college_id' => ['nullable'],
                ]);

           
                    $program = Program::findProgramByName($validated_profile['program_id']);
                    $residence = Residence::findResidenceByName($validated_profile['residence_id']);
                
                    // Check for the Exisitence of User program

                    if (!$program) {
                        // Check if user has a custom program
                        if($user->has_custom_program()){
                           $custom_program = $user->custom_program();
                           if($custom_program->name == $validated_profile['program_id'] ){
                                $program_id = NULL;
                                $college_id = NULL;
                            }else{
                               return redirect()->back()->with('failure', 'Make sure to  Select the Program from the List Provided');
                           }
                        }else{
                            return redirect()->back()->with('failure', 'Make sure to  Select the Program from the List Provided');

                        }

                        // Handle the case where either program or residence is null
                    }else{
                            $program_id = $program->id;
                            $college_id = $program->college->id;
                    }


                    // Check for the Existence of Residence
                    if (!$residence) {
                        // Check if user has a custom residence
                        if($user->has_custom_residence()){
                           $custom_residence = $user->custom_residence();
                           if($custom_residence->name == $validated_profile['residence_id'] ){
                                $residence_id = NULL;
                                $zone_id = NULL;
                            }else{
                               return redirect()->back()->with('failure', 'Make sure to  Select the residence from the List Provided');
                           }
                        }else{
                            return redirect()->back()->with('failure', 'Make sure to  Select the residence from the List Provided');

                        }

                        // Handle the case where either residence or residence is null
                    }else{
                            $residence_id = $residence->id;
                            $zone_id = $residence->zone->id;
                    }


              

                    $validated_profile['user_id'] = $user->id;
                    $validated_profile['residence_id'] = $residence_id;
                    $validated_profile['zone_id'] = $zone_id;
                    $validated_profile['program_id'] = $program_id;
                    $validated_profile['college_id'] = $college_id;
                    $validated_profile['updated_at'] = now()->format('Y-m-d H:i:s');
                    $validated_profile['created_at'] = $user->biodata->created_at->format('Y-m-d H:i:s');
                    $validated_profile['academic_year_id'] = Semester::active_semester()->academicYear->id;

                    

                    if ($validated_profile['year'] == null) {
                        $validated_profile['year'] = $user->year();
                    }

            
                    


                // NON STUDENT MEMBER
            } elseif ($user->is_student == 0 && $user->has_member_profile() == true) {
                // If user is not. Non student member Like preacher and his family or
                // N.S personelles
                // Check if the last update has been at least two months if so, create a new biodata else, update the existing one

                $validated_profile = $request->validate([
                    'room' => ['nullable'],
                    'ns_status' => ['required', 'numeric'],
                    'is_alumni' => ['required', 'numeric'],
                    'residence_id' => ['nullable'],
                    'year_group_id' => ['nullable'],

                ]);

                $validated_profile['updated_at'] = now()->format('Y-m-d H:i:s');
                $validated_profile['created_at'] = $user->biodata->created_at->format('Y-m-d H:i:s');
                $validated_profile['academic_year_id'] = Semester::active_semester()->academicYear->id;
                $validated_profile['user_id'] = $user->id;

                if ($validated_profile['is_alumni'] == 0) {
                    $validated_profile['year_group_id'] = null;
                   
                }

                // If the resdidence is null, that's when we need the zone_id from the form
                $residence = Residence::findResidenceByName($validated_profile['residence_id']);
                if ($residence == null) {
                    $validated_profile['residence_id'] = null;
                } else {
                    //   If the residence is not null, we use it and query the zone from it
                    $validated_profile['residence_id'] = $residence->id;
                    $validated_profile['zone_id'] = $residence->zone->id;
                }
            }

        } elseif ($user->is_member == 0 && $user->has_alumni_profile() == true) {
                // if User is not a member (Alumni)
                $validated_profile = $request->validate([
                    'country' => ['required'],
                    'state' => ['required'],
                    'city' => ['required'],
                    'local_congregation' => ['required'],
                    'year_group_id' => ['required'],
                ]);
                $validated_profile['user_id'] = $user->id;
                $validated_profile['updated_at'] = now()->format('Y-m-d H:i:s');
                $validated_profile['created_at'] = $user->biodata->created_at->format('Y-m-d H:i:s');
                $validated_profile['academic_year_id'] = Semester::active_semester()->academicYear->id;

        }

        $validated_contacts = $request->validate([
            'phone'=>['required'],
            'whatsapp'=>['nullable'],
            'school_voda'=>['nullable'],
            'other_contact'=>['nullable'],
            'guardian_a'=>['nullable'],
            'relation_a'=>['nullable'],
            'guardian_b'=>['nullable'],
            'relation_b'=>['nullable'],
        ]);

        // Now For the Action
        // Check for Changes and see what to do
            $contacts_unchanged = (
                $validated_contacts['phone'] == ($user->phone == null ? "" : $user->phone->body) 
            &&  $validated_contacts['whatsapp'] == ($user->whatsapp == null ? "" : $user->whatsapp->body) 
            &&  $validated_contacts['school_voda'] == ($user->school_voda == null ? "" : $user->school_voda->body) 
            &&  $validated_contacts['other_contact'] == ($user->other_contact == null ? "" : $user->other_contact->body) 
            &&  $validated_contacts['guardian_a'] == ($user->main_guardian_contact == null ? "" : $user->main_guardian_contact->body) 
            &&  $validated_contacts['relation_a'] == ($user->main_guardian_contact == null ? "" : $user->main_guardian_contact->relation) 
            &&  $validated_contacts['guardian_b'] == ($user->other_guardian_contact == null ? "" : $user->other_guardian_contact->body) 
            &&  $validated_contacts['relation_b'] == ($user->other_guardian_contact == null ? "" : $user->other_guardian_contact->relation) 
            
            ) ;
        

        // Check if The incoming is same as existing
        $incoming_biodata = MembersBiodata::make($validated_profile);
        $biodata_unchanged = (new BiodataResource($incoming_biodata))->toArray(request()) == (new BiodataResource($user->biodata))->toArray(request());
        // If No change is detected
            if( $biodata_unchanged && $contacts_unchanged){
            return redirect()->back()->with('warning','No Changes Observed');
            }

            if(!$biodata_unchanged){ 
            // If the Current User is a Ministry Member/ Leader, update right away
            if(Auth()->user()->hasAnyOf(Role::ministry_members_level()->get())){

                // Check if the last update has been at least two months if so, create a new biodata else, update the existing one
                if (now()->diffInDays($user->biodata->updated_at) >= 60) {
                    DB::table('members_biodatas')->insertOrIgnore($validated_profile);
                    // return redirect()->back()->with('success', 'Biodata Updated Successfully');

                    // If the latest update is less than 60 days, update the latest one
                } else {
                    $latest_biodata_id = $user->biodata->id;
                    DB::table('members_biodatas')->where('id', $latest_biodata_id)->update($validated_profile);

                    // return redirect()->back()->with('success', 'Biodata Updated Successfully');
                }


            // Else Create Request to be Granted later
            }else{
                    // Try and Catch Error
                    try {
                        // Your code that saves data to the database
                        $update_request = new UserRequest;
                        $update_request['user_id'] = $user->id;
                        $update_request['body'] = json_encode($validated_profile); 
                        
                        if(now()->diffInDays($user->biodata->updated_at) >= 60) {
                            $update_request['method'] = "insert";
                        }else{
                            $update_request['method'] = "update";
                            $update_request['instance_id'] = $user->biodata->id;
                        }
                        $update_request['type'] = "Biodata";
                        
                        // Whether Alumni or Members Biodata would depend on the user
                        if($user->is_member == 0 && $user->has_alumni_profile() == true){
                            $update_request['model_name'] = "App\Models\AlumniBiodata";
                            $update_request['table_name'] = "alumni_biodatas"; 
                        }else{
                            $update_request['model_name'] = "App\Models\MembersBiodata";
                            $update_request['table_name'] = "members_biodatas"; 
                        }

                        $update_request['resource_name'] = "App\Http\Resources\BiodataResource";
                        
                        $update_request['academic_year_id'] = Semester::active_semester()->academicYear->id;
                        $update_request->save();

                    } catch (QueryException $e) {
                        Log::error($e);
                    
                        $errorCode = $e->errorInfo[1];
                    
                        // Check if the error code corresponds to a unique constraint violation
                        if ($errorCode == 1062) {
                            // Redirect to a custom error page for duplicate entry
                            return redirect()->back()->with('warning', 'Your Previous Biodata Update is being processed');
                        }
                    
                        // If it's not a unique constraint violation, you can handle other database-related errors here
                        // ...
                    
                        // Re-throw the exception if it's not a unique constraint violation
                        throw $e;
                    }
            
            }
        }

        // Check and Update Contacts
            if(!$contacts_unchanged){
            
            if(Auth()->user()->hasAnyOf(Role::ministry_members_level()->get())){

                // Check Again, which amongst the contacts given differ from the existing ones and update/create them

                // Phone
                if($validated_contacts['phone'] != ($user->phone == null ? "" : $user->phone->body)){
                    // Check if user already has an existing phone
                    if($user->phone){
                        $user->phone->body = $validated_contacts['phone'];
                        $user->phone->save();
                    }else{
                        $phone = new Contact;
                            $phone->user_id = $user->id;
                            $phone->body = $validated_contacts['phone'];
                            $phone->type = "phone";
                            $phone->is_main = 1;
                            $phone->is_visible = 1;
                        $phone->save();
                    }
                }
                // whatsapp
                if($validated_contacts['whatsapp'] != ($user->whatsapp == null ? "" : $user->whatsapp->body)){
                    // Check if user already has an existing whatsapp
                    if($user->whatsapp){
                        $user->whatsapp->body = $validated_contacts['whatsapp'];
                        $user->whatsapp->save();
                    }else{
                        $whatsapp = new Contact;
                            $whatsapp->user_id = $user->id;
                            $whatsapp->body = $validated_contacts['whatsapp'];
                            $whatsapp->type = "whatsapp";
                            $whatsapp->is_main = 0;
                            $whatsapp->is_visible = 1;
                        $whatsapp->save();
                    }
                }

                // school_voda
                if($validated_contacts['school_voda'] != ($user->school_voda == null ? "" : $user->school_voda->body)){
                    // Check if user already has an existing school_voda
                    if($user->school_voda){
                        $user->school_voda->body = $validated_contacts['school_voda'];
                        $user->school_voda->save();
                    }else{
                        $school_voda = new Contact;
                            $school_voda->user_id = $user->id;
                            $school_voda->body = $validated_contacts['school_voda'];
                            $school_voda->type = "school_voda";
                            $school_voda->is_main = 0;
                            $school_voda->is_visible = 1;
                        $school_voda->save();
                    }
                }
                // other_contact
                if($validated_contacts['other_contact'] != ($user->other_contact == null ? "" : $user->other_contact->body)){
                    // Check if user already has an existing other_contact
                    if($user->other_contact != null){
                        $user->other_contact->body = $validated_contacts['other_contact'];
                        $user->other_contact->save();
                    }else{
                        $other_contact = new Contact;
                            $other_contact->user_id = $user->id;
                            $other_contact->body = $validated_contacts['other_contact'];
                            $other_contact->type = "other_contact";
                            $other_contact->is_main = 0;
                            $other_contact->is_visible = 1;
                        $other_contact->save();
                    }
                }
                //Guardian A contact
                if($validated_contacts['guardian_a'] != ($user->main_guardian_contact == null ? "" : $user->main_guardian_contact->body) 
                    || $validated_contacts['relation_a'] != ($user->main_guardian_contact == null ? "" : $user->main_guardian_contact->relation)
                ){
                    // Check if user already has an existing main_guardian_contact
                    if($user->main_guardian_contact){
                        $user->main_guardian_contact->body = $validated_contacts['guardian_a'];
                        $user->main_guardian_contact->relation = $validated_contacts['relation_a'];
                        $user->main_guardian_contact->save();
                    }else{
                        $guardian_a = new Contact;
                            $guardian_a->user_id = $user->id;
                            $guardian_a->body = $validated_contacts['guardian_a'];
                            $guardian_a->type = "guardian";
                            $guardian_a->ownership = "guardian";
                            $guardian_a->relation = $validated_contacts['relation_a'];
                            $guardian_a->is_main = 1;
                            $guardian_a->is_visible = 0;
                        $guardian_a->save();
                    }
                }

                //Guardian B contact
                if($validated_contacts['guardian_b'] != ($user->other_guardian_contact == null ? "" : $user->other_guardian_contact->body)
                    || $validated_contacts['relation_b'] != ($user->other_guardian_contact == null ? "" : $user->other_guardian_contact->relation)
                ){
                    // Check if user already has an existing other_guardian_contact
                    if($user->other_guardian_contact){
                        $user->other_guardian_contact->body = $validated_contacts['guardian_b'];
                        $user->other_guardian_contact->relation = $validated_contacts['relation_b'];
                        $user->other_guardian_contact->save();
                    }else{
                        $guardian_b = new Contact;
                            $guardian_b->user_id = $user->id;
                            $guardian_b->body = $validated_contacts['guardian_b'];
                            $guardian_b->type = "guardian";
                            $guardian_b->ownership = "guardian";
                            $guardian_b->relation = $validated_contacts['relation_b'];
                            $guardian_b->is_main = 0;
                            $guardian_b->is_visible = 0;
                        $guardian_b->save();
                    }
                }

            // If User is Not an Admin     
            }else{
                
            // Check The Difference and create the needed user request for contact model

                    // Phone
                if($validated_contacts['phone'] != ($user->phone == null ? "" : $user->phone->body)){
                    // Check if user already has an existing phone
                    if($user->phone){
                        try {
                            //Create A simple array
                            $new_phone['body'] =  $validated_contacts['phone'];

                            $phone_update_request = new UserRequest;
                            $phone_update_request['user_id'] = $user->id;
                            $phone_update_request['body'] = json_encode($new_phone);
                            $phone_update_request['table_name'] = "contacts";
                            $phone_update_request['method'] = "update";
                            $phone_update_request['instance_id'] = $user->phone->id;
                            $phone_update_request['type'] = "Contact-phone";
                            $phone_update_request['model_name'] = "App\Models\Contact";
                            $phone_update_request['resource_name'] = "App\Http\Resources\ContactResource";
                            $phone_update_request['academic_year_id'] = Semester::active_semester()->academicYear->id;
                            $phone_update_request->save();
                        } catch (QueryException $e) {
                            Log::error($e);
                            $errorCode = $e->errorInfo[1];
                            if ($errorCode == 1062) {
                                return redirect()->back()->with('warning', 'Your Previous Phone Update is being processed');
                            }
                            throw $e;
                        }

                    }else{
                        $phone = new Contact;
                            $phone->user_id = $user->id;
                            $phone->body = $validated_contacts['phone'];
                            $phone->type = "phone";
                            $phone->is_main = 1;
                            $phone->is_visible = 1;
                        $phone->save();
                    }
                }
                // whatsapp
                if($validated_contacts['whatsapp'] != ($user->whatsapp == null ? "" : $user->whatsapp->body)){
                    // Check if user already has an existing whatsapp
                    if($user->whatsapp){
                        try {
                            $new_whatsapp['body'] =  $validated_contacts['whatsapp'];

                            $whatsapp_update_request = new UserRequest;
                            $whatsapp_update_request['user_id'] = $user->id;
                            $whatsapp_update_request['body'] = json_encode($new_whatsapp);
                            $whatsapp_update_request['table_name'] = "contacts";
                            $whatsapp_update_request['method'] = "update";
                            $whatsapp_update_request['instance_id'] = $user->whatsapp->id;
                            $whatsapp_update_request['type'] = "Contact-whatsapp";
                            $whatsapp_update_request['model_name'] = "App\Models\Contact";
                            $whatsapp_update_request['resource_name'] = "App\Http\Resources\ContactResource";
                            $whatsapp_update_request['academic_year_id'] = Semester::active_semester()->academicYear->id;
                            $whatsapp_update_request->save();
                        } catch (QueryException $e) {
                            Log::error($e);
                            $errorCode = $e->errorInfo[1];
                            if ($errorCode == 1062) {
                                return redirect()->back()->with('warning', 'Your Previous WhatsApp Contact Update is being processed');
                            }
                            throw $e;
                        }
                    }else{
                        $whatsapp = new Contact;
                            $whatsapp->user_id = $user->id;
                            $whatsapp->body = $validated_contacts['whatsapp'];
                            $whatsapp->type = "whatsapp";
                            $whatsapp->is_main = 0;
                            $whatsapp->is_visible = 1;
                        $whatsapp->save();
                    }
                }

                // school_voda
                if($validated_contacts['school_voda'] != ($user->school_voda == null ? "" : $user->school_voda->body)){
                    // Check if user already has an existing school_voda
                    if($user->school_voda){
                        try {
                            $new_school_voda['body'] =  $validated_contacts['school_voda'];

                            $school_voda_update_request = new UserRequest;
                            $school_voda_update_request['user_id'] = $user->id;
                            $school_voda_update_request['body'] = json_encode($new_school_voda);
                            $school_voda_update_request['table_name'] = "contacts";
                            $school_voda_update_request['method'] = "update";
                            $school_voda_update_request['instance_id'] = $user->school_voda->id;
                            $school_voda_update_request['type'] = "Contact-school_voda";
                            $school_voda_update_request['model_name'] = "App\Models\Contact";
                            $school_voda_update_request['resource_name'] = "App\Http\Resources\ContactResource";
                            $school_voda_update_request['academic_year_id'] = Semester::active_semester()->academicYear->id;
                            $school_voda_update_request->save();
                        } catch (QueryException $e) {
                            Log::error($e);
                            $errorCode = $e->errorInfo[1];
                            if ($errorCode == 1062) {
                                return redirect()->back()->with('warning', 'Your Previous School Voda Update is being processed');
                            }
                            throw $e;
                        }
                    }else{
                        $school_voda = new Contact;
                            $school_voda->user_id = $user->id;
                            $school_voda->body = $validated_contacts['school_voda'];
                            $school_voda->type = "school_voda";
                            $school_voda->is_main = 0;
                            $school_voda->is_visible = 1;
                        $school_voda->save();
                    }
                }
                // other_contact
                if($validated_contacts['other_contact'] != ($user->other_contact == null ? "" : $user->other_contact->body)){
                    // Check if user already has an existing other_contact
                    if($user->other_contact){
                        try {
                            $new_other_contact['body'] =  $validated_contacts['other_contact'];

                            $other_contact_update_request = new UserRequest;
                            $other_contact_update_request['user_id'] = $user->id;
                            $other_contact_update_request['body'] = json_encode($new_other_contact);
                            $other_contact_update_request['table_name'] = "contacts";
                            $other_contact_update_request['method'] = "update";
                            $other_contact_update_request['instance_id'] = $user->other_contact->id;
                            $other_contact_update_request['type'] = "Contact-other_contact";
                            $other_contact_update_request['model_name'] = "App\Models\Contact";
                            $other_contact_update_request['resource_name'] = "App\Http\Resources\ContactResource";
                            $other_contact_update_request['academic_year_id'] = Semester::active_semester()->academicYear->id;
                            $other_contact_update_request->save();
                        } catch (QueryException $e) {
                            Log::error($e);
                            $errorCode = $e->errorInfo[1];
                            if ($errorCode == 1062) {
                                return redirect()->back()->with('warning', 'Your Previous Other Contact Update is being processed');
                            }
                            throw $e;
                        }

                    }else{
                        $other_contact = new Contact;
                            $other_contact->user_id = $user->id;
                            $other_contact->body = $validated_contacts['other_contact'];
                            $other_contact->type = "other_contact";
                            $other_contact->is_main = 0;
                            $other_contact->is_visible = 1;
                        $other_contact->save();
                    }
                }
                //Guardian A contact
                if($validated_contacts['guardian_a'] != ($user->main_guardian_contact == null ? "" : $user->main_guardian_contact->body) 
                    || $validated_contacts['relation_a'] != ($user->main_guardian_contact == null ? "" : $user->main_guardian_contact->relation)
                    ){
                    // Check if user already has an existing main_guardian_contact
                    if($user->main_guardian_contact){

                        try {
                            $new_guardian_a['body'] =  $validated_contacts['guardian_a'];
                            $new_guardian_a['relation'] =  $validated_contacts['relation_a'];

                            $guardian_a_update_request = new UserRequest;
                            $guardian_a_update_request['user_id'] = $user->id;
                            $guardian_a_update_request['body'] = json_encode($new_guardian_a);
                            $guardian_a_update_request['table_name'] = "contacts";
                            $guardian_a_update_request['method'] = "update";
                            $guardian_a_update_request['instance_id'] = $user->main_guardian_contact->id;
                            $guardian_a_update_request['type'] = "Contact-guardian_a";
                            $guardian_a_update_request['model_name'] = "App\Models\Contact";
                            $guardian_a_update_request['resource_name'] = "App\Http\Resources\ContactResource";
                            $guardian_a_update_request['academic_year_id'] = Semester::active_semester()->academicYear->id;
                            $guardian_a_update_request->save();
                        } catch (QueryException $e) {
                            Log::error($e);
                            $errorCode = $e->errorInfo[1];
                            if ($errorCode == 1062) {
                                return redirect()->back()->with('warning', 'Your Previous Main Guardian Contact is being processed');
                            }
                            throw $e;
                        }

                    }else{
                        $guardian_a = new Contact;
                            $guardian_a->user_id = $user->id;
                            $guardian_a->body = $validated_contacts['guardian_a'];
                            $guardian_a->type = "guardian";
                            $guardian_a->ownership = "guardian";
                            $guardian_a->relation = $validated_contacts['relation_a'];
                            $guardian_a->is_main = 1;
                            $guardian_a->is_visible = 0;
                        $guardian_a->save();
                    }
                }

                //Guardian B contact
                if($validated_contacts['guardian_b'] != ($user->other_guardian_contact == null ? "" : $user->other_guardian_contact->body)
                    || $validated_contacts['relation_b'] != ($user->other_guardian_contact == null ? "" : $user->other_guardian_contact->relation)
                    ){
                    // Check if user already has an existing other_guardian_contact
                    if($user->other_guardian_contact){

                        try {
                            $new_guardian_b['body'] =  $validated_contacts['guardian_b'];
                            $new_guardian_b['relation'] =  $validated_contacts['relation_b'];

                            $guardian_b_update_request = new UserRequest;
                            $guardian_b_update_request['user_id'] = $user->id;
                            $guardian_b_update_request['body'] = json_encode($new_guardian_b);
                            $guardian_b_update_request['table_name'] = "contacts";
                            $guardian_b_update_request['method'] = "update";
                            $guardian_b_update_request['instance_id'] = $user->other_guardian_contact->id;
                            $guardian_b_update_request['type'] = "Contact-guardian_b";
                            $guardian_b_update_request['model_name'] = "App\Models\Contact";
                            $guardian_b_update_request['resource_name'] = "App\Http\Resources\ContactResource";
                            $guardian_b_update_request['academic_year_id'] = Semester::active_semester()->academicYear->id;
                            $guardian_b_update_request->save();
                        } catch (QueryException $e) {
                            Log::error($e);
                            $errorCode = $e->errorInfo[1];
                            if ($errorCode == 1062) {
                                return redirect()->back()->with('warning', 'Your Previous Other Guardian Contact Update is being processed');
                            }
                            throw $e;
                        }
                    }else{
                        $guardian_b = new Contact;
                            $guardian_b->user_id = $user->id;
                            $guardian_b->body = $validated_contacts['guardian_b'];
                            $guardian_b->type = "guardian";
                            $guardian_b->ownership = "guardian";
                            $guardian_b->relation = $validated_contacts['relation_b'];
                            $guardian_b->is_main = 0;
                            $guardian_b->is_visible = 0;
                        $guardian_b->save();
                    }
                }

            }
        }

        if( auth()->user()->hasAnyOf(Role::ministry_members_level()->get())){
            return redirect()->back()->with('success','Update Successful');

        }else{
            return redirect()->back()->with('success','Done! Changes may reflect soon');
        }



        return redirect(route('create_user_profile_form',['user'=>$user]))->with('warning','Please Update Your Profile');

    }

    // DELETE PROFILE
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
