<?php

namespace App\Http\Controllers;

use App\Models\College;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('academia.colleges.index');
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
    public function show(College $college)
    {
        //
        return view('academia.colleges.show', ['college' => $college, 'programs' => $college->programs]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(College $college)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, College $college)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(College $college)
    {
        //
    }

    // Search User for a particular college
    public function search_college_user(Request $request, College $college)
    {

        $string = $request->input('str');

        if (! empty($string)) {
            $str = '%'.$string.'%';
            $users = $college->users()->where('firstname', 'like', $str)
                ->orWhere('lastname', 'like', $str)
                            // ->paginate($perPage = 25, $columns = ['*'], $pageName = "SearchResults" );
                ->get();

            return view('academia.colleges.components.users.search-results', ['users' => $users, 'college' => $college]);

        } else {
            // If string is empty, return the original paginated data

            $users = $college->users;

            return view('academia.colleges.components.users.search-results', ['users' => $users, 'college' => $college]);

        }

    }

    // Search programs for a particular college
    public function search_college_program(Request $request, College $college)
    {

        $string = $request->input('str');

        if (! empty($string)) {
            $str = '%'.$string.'%';
            $programs = $college->programs()->where('name', 'like', $str)->get();

            return view('academia.colleges.components.programs.search-results', ['programs' => $programs, 'college' => $college]);

        } else {
            // If string is empty, return the original paginated data

            $programs = $college->programs;

            return view('academia.colleges.components.programs.search-results', ['programs' => $programs, 'college' => $college]);

        }

    }
}
