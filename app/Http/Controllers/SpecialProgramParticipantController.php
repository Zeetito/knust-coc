<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpecialProgram;
use App\Models\SpecialProgramParticipant;

class SpecialProgramParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SpecialProgram $special_program)
    {
        return view('special_program.participant.index',['special_program'=>$special_program]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(SpecialProgram $special_program)
    {
        return view('special_program.participant.create',['special_program'=>$special_program]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, SpecialProgram $special_program)
    {
        //
        $participant = new SpecialProgramParticipant;
        $participant->firstname = $request->input('firstname');
        $participant->othername = $request->input('othername');
        $participant->lastname = $request->input('lastname');
        $participant->gender = $request->input('gender');
        $participant->congregation = $request->input('congregation');
        $participant->phone = $request->input('phone');
        $participant->special_program_id = $special_program->id;
        $participant->save();

        return redirect()->back()->with('success','Participant Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SpecialProgramParticipant $SpecialProgramParticipant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SpecialProgramParticipant $special_program_participant)
    {
        return view('special_program.participant.edit',['participant'=>$special_program_participant]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SpecialProgramParticipant $special_program_participant)
    {
        $participant = $special_program_participant;

        $participant->firstname = $request->input('firstname');
        $participant->lastname = $request->input('lastname');
        $participant->othername = $request->input('othername');
        $participant->phone = $request->input('phone');
        $participant->special_program_residence_id = $request->input('residence_id');
        $participant->special_program_room_id_text = $request->input('room');

        $participant->save();

        return redirect()->back()->with('success','Participant Updated Successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpecialProgramParticipant $SpecialProgramParticipant)
    {
        //
    }
}
