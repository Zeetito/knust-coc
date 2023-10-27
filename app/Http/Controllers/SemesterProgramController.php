<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guest;
use App\Models\Semester;
use Illuminate\Http\Request;
use App\Models\SemesterProgram;
use Illuminate\Support\Facades\DB;

class SemesterProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            
        //
        $semester_programs = Semester::where('is_active',1)->first()->semester_programs();
        return view('semester-programs.index',['semester_programs'=>$semester_programs]);
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
            'name' => ['required'],
            'venue' => ['required'],
            'start_date' => ['required', 'date'],
            'end_date' => ['date', 'nullable'],
        ]);
            // If End Date is null, the end date is set to start date
        if($validated['end_date'] == null ){
            $validated['end_date'] = $validated['start_date'];
        }

        // return $validated;
        SemesterProgram::create($validated);

        return redirect(route('semester_programs'))->with('success','Semester Program Added Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(SemesterProgram $semesterProgram)
    {
        //
        // return $semesterProgram;
        return view('semester-programs.show',['semester_program'=>$semesterProgram]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SemesterProgram $semesterProgram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SemesterProgram $semesterProgram)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SemesterProgram $semesterProgram)
    {
        //
    }

    // filter_semester_programs
    public function filter_semester_programs(Request $request){
        $sem_id = $request->input('str');

        if(empty($sem_id)){
            Semester::where('is_active',1)->semester_programs();
        }else{
            $semester_programs = Semester::find($sem_id)->semester_programs();
        }
            return view('semester-programs.components.search-results',['semester_programs'=>$semester_programs]);
        // return 
    }

    // Add Officiator Page
    public function add_officiator_form(SemesterProgram $semesterProgram){
        // return $semesterProgram;
        $users = User::paginate50();
        return view('semester-programs.components.officiators.create',['semester_program'=>$semesterProgram, 'users'=>$users]);
    }


    // Search User by name for officiating role
    public function search_user_officiator(Request $request){
        $users = User::search_user($request)->get();
        // return $users;
        return view('semester-programs.components.officiators.users.search-results',['users'=>$users]);
    }

// Store Officiator Instance
    public function store_officiator(Request $request, SemesterProgram $semesterProgram){
        
        // Check whether officiator is user or guest to know the validation requirements
        // If Officiator is A User
        if($request['status'] == 'user'){
            $validated = $request->validate([
                // 'officiator_id'=>['required','numeric'],
                'user_officiating_role_id'=>['required','numeric'],
                'user_id'=>['required','numeric'],
                ]);

                // Check if the same instance exist and stop
            DB::table('officiators_programs')->insertOrIgnore([
                'is_user' => 1,
                'officiator_id' => $validated['user_id'],
                'officiating_role_id' => $validated['user_officiating_role_id'],
                'semester_program_id' => $semesterProgram->id,
                
            ]);

            // After Inserting return to same page
            return redirect()->back()->with('success','Officiator Added Successfully');
        
       

        }else{
            // If Officiator is a Guest
            $validated = $request->validate([
                'guest_name'=>['required','min:8'],
                'local_congregation'=>['required','min:5'],
                'guest_officiating_role_id'=>['required','numeric'],
            ]);
            
            // Create A Guest
            $guest = New Guest;
            $guest['fullname'] = $validated['guest_name'];
            $guest['is_member'] = 1;
            $guest['local_congregation'] = $validated['local_congregation'];
            $guest->save();

            DB::table('officiators_programs')->insertOrIgnore([
                'is_user' => 0,
                'officiator_id' => $guest->id,
                'officiating_role_id' => $validated['guest_officiating_role_id'],
                'semester_program_id' => $semesterProgram->id,
            ]);

             // After Inserting return to same page
             return redirect()->back()->with('success','Officiator Added Successfully');
        }
    }


    // Remove Officiator
        public function remove_officiator(SemesterProgram $semesterProgram, $officiator, $status, $role){
            $user_status = $status;

            // Find officiator based on the status i.e user of guest

            // If user
            if($status ==1 ){
                // Get The user instance
                $officiator = User::find($officiator);
            // if Guest
            }elseif($status == 0){
                $officiator = Guest::find($officiator);
            }

            // Check for the Particualr instacne and delete for the particular officiator
            $instance = DB::table('officiators_programs')
            // Using the is_user status to query for user or guest
            ->where('is_user',$user_status)
            ->join('officiating_roles','officiators_programs.officiating_role_id','officiating_roles.id')
            ->where('officiator_id',$officiator->id)
            ->where('officiating_role_id',$role)
            ->where('semester_program_id',$semesterProgram->id)
            ;
            // Delete the instacne
            $instance->delete();
            return redirect(route('show_semester_program',['semesterProgram'=>$semesterProgram]))->with('success','Delete Successful');
        }

    // Show Edit officiator form - Modal
        public function edit_officiator(SemesterProgram $semesterProgram, $officiator, $status, $role){
            // Check if the officiator is a guest of user first

            $user_status = $status;
            if($status ==1){
                // return edit user officiator modal
                return view('semester-programs.components.officiators.users.edit-officiator-modal',['semesterProgram'=>$semesterProgram, 'officiator'=>$officiator , 'status'=>$status, 'role'=>$role]);
            }else{
                // return edit guest officiator modal
                return view('semester-programs.components.officiators.guests.edit-officiator-modal',['semesterProgram'=>$semesterProgram, 'officiator'=>$officiator , 'status'=>$status, 'role'=>$role]);
            }
            
        }


    // Confirm Officiator Delete - Modal
        public function confirm_officiator_delete(SemesterProgram $semesterProgram, $officiator, $status, $role){
            // Check if the officiator is a guest of user first

            $user_status = $status;
            if($status ==1){
                // return edit user officiator modal
                return view('semester-programs.components.officiators.users.confirm-delete-modal',['semesterProgram'=>$semesterProgram, 'officiator'=>$officiator , 'status'=>$status, 'role'=>$role]);
            }else{
                // return edit guest officiator modal
                return view('semester-programs.components.officiators.guests.confirm-delete-modal',['semesterProgram'=>$semesterProgram, 'officiator'=>$officiator , 'status'=>$status, 'role'=>$role]);
            }
            
        }

    // Update Officiator
        public function update_officiator(Request $request, SemesterProgram $semesterProgram, $officiator, $status, $role){
            $user_status = $status;

            // Find officiator based on the status i.e user of guest

            // If user
            if($status ==1 ){
                // Get The user instance
                $officiator = User::find($officiator);

                // Validate the input for user
                $validated = $request->validate([
                    'user_id' => ['required','numeric'],
                    'user_officiating_role_id' => ['required','numeric'],
                ]);
                $validated['officiator_id'] = $validated['user_id'];
                $validated['officiating_role_id'] = $validated['user_officiating_role_id'];

                unset($validated['user_id']);
                unset($validated['user_officiating_role_id']);

            // if Guest
            }elseif($status == 0){
                $officiator = Guest::find($officiator);

                // Validate the input for the guest
                $validated = $request->validate([
                    'guest_officiating_role_id' => ['required','numeric'],
                ]);
                $validated['officiator_id'] = $officiator->id;
                $validated['officiating_role_id'] = $validated['guest_officiating_role_id'];

                unset($validated['guest_officiating_role_id']);

            }

            

            // Check for the Particualr instacne and delete for the particular officiator
            $instance = DB::table('officiators_programs')
            // Using the is_user status to query for user or guest
            ->where('is_user',$user_status)
            ->join('officiating_roles','officiators_programs.officiating_role_id','officiating_roles.id')
            ->where('officiator_id',$officiator->id)
            ->where('officiating_role_id',$role)
            ->where('semester_program_id',$semesterProgram->id)
            ;
            // Delete the instacne
            $instance->update($validated);
            return redirect(route('show_semester_program',['semesterProgram'=>$semesterProgram]))->with('success','Update Successful');
            // Now return the updated row

        }



}
