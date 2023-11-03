<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('academia.faculties.index');

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
    public function show(Faculty $faculty)
    {
        //
        return view('academia.faculties.show', ['faculty' => $faculty, 'programs' => $faculty->programs, 'users' => $faculty->users()->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faculty $faculty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faculty $faculty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faculty $faculty)
    {
        //
    }

    // Search User for a particular faculty
    public function search_faculty_user(Request $request, Faculty $faculty)
    {

        $string = $request->input('str');

        if (! empty($string)) {
            $str = '%'.$string.'%';
            $users = $faculty->users()->where('firstname', 'like', $str)
                ->orWhere('lastname', 'like', $str)
                            // ->paginate($perPage = 25, $columns = ['*'], $pageName = "SearchResults" );
                ->get();

            return view('academia.faculties.components.users.search-results', ['users' => $users, 'faculty' => $faculty]);

        } else {
            // If string is empty, return the original paginated data

            $users = $faculty->users()->get();

            return view('academia.faculties.components.users.search-results', ['users' => $users, 'faculty' => $faculty]);

        }

    }

    // Search programs for a particular Faculty
    public function search_faculty_program(Request $request, Faculty $faculty)
    {

        $string = $request->input('str');

        if (! empty($string)) {
            $str = '%'.$string.'%';
            $programs = $faculty->programs()->where('name', 'like', $str)->get();

            return view('academia.faculties.components.programs.search-results', ['programs' => $programs, 'faculty' => $faculty]);

        } else {
            // If string is empty, return the original paginated data

            $programs = $faculty->programs;

            return view('academia.faculties.components.programs.search-results', ['programs' => $programs, 'faculty' => $faculty]);

        }

    }
}
