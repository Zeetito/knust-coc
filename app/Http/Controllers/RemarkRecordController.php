<?php

namespace App\Http\Controllers;

use App\Models\Remark;
use App\Models\Semester;
use App\Models\RemarkRecord;
use Illuminate\Http\Request;

class RemarkRecordController extends Controller
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
        $remarkable_id = $request->input('remarkable_id');
        $remarkable_type = $request->input('remarkable_type');
        $remarkerable_type = $request->input('remarkerable_type');
        $remarkerable_id = $request->input('remarkerable_id');

        // Check if a remark instane already exists
        if($request->input('remark_id') == null){
            // Create one if not
            $remark =  new Remark;
            $remark->remarkable_id = $remarkable_id;
            $remark->remarkable_type = $remarkable_type;
            $remark->remarkerable_id = $remarkerable_id;
            $remark->remarkerable_type = $remarkerable_type;
            $remark->semester_id = Semester::active_semester()->id;
            // Save the instance            
            $remark->save();

        }else{
            $remark = Remark::find($request->input('remark_id'));
        }

        // Store the Record instance
        $record =  new RemarkRecord;
        $record->remark_id = $remark->id;
        $record->body = $request->input('body');
        $record->type = $request->input('type');
        $record->created_by = auth()->user()->id;
        $record->save();
        //

        return redirect()->back()->with('success','Success!');

    }

    /**
     * Display the specified resource.
     */
    public function show(RemarkRecord $remarkRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RemarkRecord $remark_record)
    {
        if($remark_record){
            return view('remarks.edit',compact(['remark_record']));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RemarkRecord $remark_record)
    {
        if($request->input('body') != null ){
            $remark_record->body = $request->input('body');
            $remark_record->updated_by =  auth()->user()->id;
            $remark_record->save();
            return redirect()->back()->with('success','Update Successful!');
        }else{
            return redirect()->back()->with('failure','Update failed!');
        }
    }

    // Confirm Delete
    public function confirm_delete(RemarkRecord $remark_record){
        return view('remarks.delete',compact(['remark_record']));
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(RemarkRecord $remark_record)
    {
        if($remark_record){
            $remark_record->delete();
            return redirect()->back()->with('warning','Entry Deleted');
        }else{
            return redirect()->back()->with('failure','Invalid Record');

        }
    }
}
