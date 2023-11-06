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
    public function delete(SemesterProgram $semesterProgram, $programOutline)
    {
        $session = DB::table('program_outlines')->where('id', $programOutline);
        $position = $session->first()->position;
        $session->delete();

        return redirect()->back()->with('success', 'Session Deleted Successfully');
    }

    public function update(Request $request, SemesterProgram $semesterProgram, $programOutline_id)
    {
        $this_programOutline = DB::table('program_outlines')->where('id', $programOutline_id);
        $oldOutline = $this_programOutline->first();
        $this_programOutline->delete();

        $validated = $request->validate([
            'name' => ['required', 'min:2'],
            'officiator_id' => ['required'],
            'start_time' => ['time', 'nullable'],
            'end_time' => ['time', 'nullable'],
            // 'description' => ['nullable'],
            'position' => ['required', 'numeric'],
        ]);
        $validated['semester_program_id'] = $semesterProgram->id;

        // Refresh Positions
        $sessions = $semesterProgram->outline();
        // If there is a change in posistion, refresh the positions of the others.
        if ($validated['position'] != $oldOutline->position) {
            $sessions->where('position', '>=', $validated['position'])
                ->increment('position');
        }
        // Now reinsert the outline with it's new/old position
        DB::table('program_outlines')->insertOrIgnore([
            'name' => $validated['name'],
            'officiator_id' => $validated['officiator_id'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'position' => $validated['position'],
            // 'description' => $validated['description'],
            'semester_program_id' => $semesterProgram->id,
            'created_at' => $oldOutline->created_at,
            'updated_at' => now(),
        ]);

        // Now insert again this particular outline and save it with it's new position.

        return redirect()->back()->with('success', 'Session Updated successfully');

    }
}
