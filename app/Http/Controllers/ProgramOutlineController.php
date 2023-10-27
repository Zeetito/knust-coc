<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SemesterProgram;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProgramOutlineController extends Controller
{
    //

    // Show the form for creating new resource
    public function create(){

    }

    public function store(Request $request, SemesterProgram $semester_program){

        $validated = $request->validate([
            'name'=>['required','min:5'],
            'officiator_id'=>['required'],
            'start_time'=>['time'],
            'end_time'=>['time'],
            'description'=>['min:10'],
        ]);

        // $validated['semester_program_id'] = $semester_program->id;

        $instance = DB::table('program_outlines')
                    ->where('semester_program_id',$semester_program->id)
                    ->where('officiator_id',$validated['officiator_id'])
                    ;
        
        if($instance->exists()){


        }else{
            
            DB::table('program_outlines')->insert([
                'name' => $validated['name'],
                'officiator_id' => $validated['officiator_id'],
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
                'description' => $validated['description'],
                'semester_program_id' => $semester_program->id
            ]);
            
        }

      

    }
    
}
