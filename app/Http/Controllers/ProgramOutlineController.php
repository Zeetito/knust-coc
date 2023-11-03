<?php

namespace App\Http\Controllers;

use App\Models\SemesterProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramOutlineController extends Controller
{
    //

    // Show the form for creating new program outline/session
    public function create(SemesterProgram $semesterProgram)
    {
        return view('semester-programs.program-outlines.create', ['semesterProgram' => $semesterProgram, 'counter' => 0]);
    }

    // Store program outline or session
    public function store(Request $request, SemesterProgram $semesterProgram)
    {

        $validated = $request->validate([
            'name' => ['required', 'min:5'],
            'officiator_id' => ['required'],
            'start_time' => ['time', 'nullable'],
            'end_time' => ['time', 'nullable'],
            // 'description' => ['nullable'],
            'position' => ['required', 'numeric'],
        ]);
        $validated['semester_program_id'] = $semesterProgram->id;

        DB::table('program_outlines')->insertOrIgnore([
            'name' => $validated['name'],
            'officiator_id' => $validated['officiator_id'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'position' => $validated['position'],
            // 'description' => $validated['description'],
            'semester_program_id' => $semesterProgram->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Session Added Successfully');
    }

    // Confirm Update
    public function confirm_update(SemesterProgram $semesterProgram, $programOutline)
    {
        $programOutline = DB::table('program_outlines')->where('id', $programOutline)->first();
        return view('semester-programs.program-outlines.components.confirm-update', ['semesterProgram' => $semesterProgram, 'programOutline' => $programOutline]);
    }

    // Confirm Delete
    public function confirm_delete(SemesterProgram $semesterProgram, $programOutline)
    {
        $programOutline = DB::table('program_outlines')->where('id', $programOutline)->first();
        return view('semester-programs.program-outlines.components.confirm-delete', ['semesterProgram' => $semesterProgram, 'programOutline' => $programOutline]);
    }

    // Delete Program Outline
    public function delete(SemesterProgram $semesterProgram, $programOutline){
       $session = DB::table('program_outlines')->where('id', $programOutline);
       $position =  $session->first()->position;
       $session->delete();
        // Refresh the positions of the program OUtlines or sessions
        $sessions = $semesterProgram->outline();
        for($i=$position+1; $i<=$sessions->count() - 1; $i++){
            $variable = $semesterProgram->outline()->where('position',$i);
            $variable->first()->position = ($i - 1);
            $variable->save();
        }
        return redirect()->back()->with('success','Session Deleted Successfully');
    }

    public function update(Request $request, SemesterProgram $semesterProgram, $programOutline_id){
        $validated = $request->validate([
            'name' => ['required', 'min:5'],
            'officiator_id' => ['required'],
            'start_time' => ['time', 'nullable'],
            'end_time' => ['time', 'nullable'],
            // 'description' => ['nullable'],
            'position' => ['required', 'numeric'],
        ]);
        $validated['semester_program_id'] = $semesterProgram->id;

        // Refresh Positions
        $sessions = $semesterProgram->outline();
        for($i=$validated['position']; $i<=$sessions->count(); $i++){
            $variable = $sessions->where('position',$i)
            ->update(['position' => ($i + 1)])            
            ;
        }
        // Updating the Session
            DB::table('program_outlines')->where('id', $programOutline_id)
            ->update(['position' => $validated['position']])  
        ;
        return redirect()->back()->with('success','Session Updated successfully');

    }

}
