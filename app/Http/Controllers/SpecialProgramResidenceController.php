<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpecialProgram;
use App\Models\SpecialProgramRoom;
use App\Models\SpecialProgramResidence;
use App\Models\SpecialProgramParticipant;

class SpecialProgramResidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SpecialProgram $special_program)
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(SpecialProgram $special_program)
    {
    
        return view('special_program.residence.create',['special_program'=>$special_program]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, SpecialProgram $special_program)
    {
        $residence = new SpecialProgramResidence;
        $residence->name = $request->input('name');
        $residence->location = $request->input('location');
        $residence->special_program_id = $special_program->id;
        $residence->save();

        return redirect()->back()->with('success','Residence Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SpecialProgramResidence $special_program_residence)
    {
        return view('special_program.residence.show',['special_program_residence'=>$special_program_residence]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SpecialProgramResidence $SpecialProgramResidence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SpecialProgramResidence $SpecialProgramResidence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpecialProgramResidence $SpecialProgramResidence)
    {
        //
    }

    // Create participant
    public function create_participant(SpecialProgramResidence $special_program_residence){
        return view('special_program.residence.participant.create',['special_program_residence'=>$special_program_residence]);
    }

    // Store participant
    public function store_participant(Request $request, SpecialProgramResidence $special_program_residence){
        
        $participant = new SpecialProgramParticipant;
        $participant->firstname = $request->input('firstname');
        $participant->lastname = $request->input('lastname');
        $participant->firstname = $request->input('firstname');
        $participant->phone = $request->input('contact');
        $participant->special_program_id = $special_program_residence->special_program->id;
        $participant->special_program_room_id = $request->input('room');
        $participant->gender = $request->input('gender');
        $participant->special_program_residence_id = $special_program_residence->id;
        $participant->save();
        return redirect()->back()->with('success','Participant Added Successfully');
    }

    // Create Room
    public function create_room(SpecialProgramResidence $special_program_residence){
        return view('special_program.residence.room.create',['special_program_residence'=>$special_program_residence]);
    }

    // Store Room
    public function store_room(Request $request, SpecialProgramResidence $special_program_residence){
        $room = new SpecialProgramRoom;
        $room->name = $request->input('name');
        $room->floor = $request->input('floor');
        $room->size = $request->input('size');
        $room->special_program_residence_id = $special_program_residence->id;
        $room->save();
        return redirect()->back()->with('success','Room Added Successfully');
    }

    // get_special_program_room_list
    public function get_special_program_room_list(Request $request, SpecialProgram $special_program) {
        $residence = $request->input('variable');
    
        $rooms = SpecialProgramRoom::where('special_program_residence_id', $residence)->get();
    
        // Generate the HTML for the select element
        $roomHtml = '<option value="">Select Room</option>';
    
        foreach ($rooms as $room) {
            $roomHtml .= '<option value="' . $room->id . '">' . $room->name . ' Gender: ' . ($room->gender == 'm' ? 'Male' : 'Female') . '</option>';
        }
    
        return $roomHtml;
    }


}
