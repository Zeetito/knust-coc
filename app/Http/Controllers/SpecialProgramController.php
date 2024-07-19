<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use App\Models\SpecialProgram;

class SpecialProgramController extends Controller
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
        return view('special_program.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $program = new SpecialProgram;
        $program->name = $request->input('name');
        $program->start_date = $request->input('start_date');
        $program->end_date = $request->input('end_date');
        $program->is_active = 1;
        $program->semester_id = Semester::active_semester()->id;
        $program->user_id = auth()->user()->id;
        $program->save();

        return redirect(route('show_special_program',['special_program'=>$program->id]))->with('success','Special Program Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SpecialProgram $special_program)
    {
        //
        return view('special_program.show',['special_program'=>$special_program]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SpecialProgram $SpecialProgram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SpecialProgram $SpecialProgram)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpecialProgram $SpecialProgram)
    {
        //
    }

    
}
