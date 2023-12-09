<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('housing.zones.index');
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
    public function show(Zone $zone)
    {
        //
        // return view('housing.zones.show',['zone'=>$zone]);
        return view('housing.zones.show', compact('zone'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Zone $zone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Zone $zone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zone $zone)
    {
        //
    }

    // View student Zone members
    public function view_zone_mates(User $user){
        return view('users.components.special.zone-members.index',['user'=>$user]);
        
    }
    
    // Search Zone Members
    public function search_zone_members(User $user, Request $request){

        $users_id = User::search_user($request)
                    ->where('users.is_student',1)
                    ->where('users.is_member', 1)
                    ->join('members_biodatas', 'members_biodatas.user_id', '=', 'users.id')
                    ->where('users.id', '<>', $user->id)
                    ->where('members_biodatas.program_id', $user->program()->id)
                    ->pluck('users.id');
        // return $users_id;
                    

        $users =  User::whereIn('id',$users_id)->get();
        return view('users.students.special.program-mates.search-results',['mates'=>$users, 'user'=>$user]);
    }
}
