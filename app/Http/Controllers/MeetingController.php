<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('meetings.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('meetings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name'=>['required','min:4'],
            'description' => ['nullable']
        ]);

        Meeting::create($validated);

        return redirect()->back()->with('success','Meeting Added Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Meeting $meeting)
    {
        //
        return view('meetings.show',['meeting'=>$meeting]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meeting $meeting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meeting $meeting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meeting $meeting)
    {
        //
        $meeting->delete();
        return redirect()->back()->with('warning','Meeting Deleted Successfully');
    }

    // confirm delete
    public function confirm_delete(Meeting $meeting){
        return view('meetings.delete',['meeting'=>$meeting]);
    }
}
