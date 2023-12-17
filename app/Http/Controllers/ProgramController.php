<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Program;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class ProgramController extends Controller
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
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        //
    }

    // View student program mates
    public function view_program_mates(User $user){
        // $program_mates = $user->program_mates;
        return view('users.components.special.program-mates.index',['user'=>$user]);
    }
    
    
    // Search Program mates
    public function search_program_mates(User $user, Request $request){

        $users_id = User::search_user($request)
                    ->where('users.is_student',1)
                    ->where('users.is_member', 1)
                    ->join('members_biodatas', 'members_biodatas.user_id', '=', 'users.id')
                    ->where('users.id', '<>', $user->id)
                    ->where('members_biodatas.program_id', $user->program()->id)
                    ->pluck('users.id');
        // return $users_id;
                    

        $users =  User::whereIn('id',$users_id)->get();
        return view('users.components.special.program-mates.search-results',['mates'=>$users, 'user'=>$user]);
    }

    // Create User-program
    public function create_user_program(User $user){
        return view('profile.components.members.students.unknown-program.create',['user'=>$user]);
    }

    // Store User Program 
    public function store_user_program(Request $request, User $user){
        $validated = $request->validate([
            'name'=>['required'],
            'category'=>['required'],
            'college_id'=>['required'],
            'span'=>['nullable']
        ]);

        $instance['user_id'] = $user->id;
        $instance['name'] = $validated['name'];
        $instance['status'] = $validated['category'];
        $instance['college_id'] = $validated['college_id'];
        $instance['span'] = $validated['span'];
        $instance['academic_year_id'] = Semester::active_semester()->academicYear->id;
        $instance['created_at'] = now();
        $instance['updated_at'] = now();

        try{
        DB::table('user_programs')->insert($instance);
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

    // Update Biodata Program
    public function  update_biodata_program(Request $request, User $user){

        $validated =  $request->validate([
            'program_id' => ['required'],
        ]);

        $program = Program::findProgramByName($validated['program_id']);
                
        if (!$program) {
            // Handle the case where either program or residence is null
            return redirect()->back()->with('failure', 'Make sure to  Select the Residence from the List Provided');
        }
        
        $update['program_id'] = $program->id;
        $update['college_id'] = $program->college->id;

        $user->biodata->update($update);

        return redirect(route('view_profile',['user'=>$user]))->with('success','You have now completed Your Profile');

    }

}
