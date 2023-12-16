<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function create_user(Permission $permission){
        return view('permissions.permission-users.create',['permission'=>$permission]);   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function assign_permission(Request $request, Permission $permission){
        $validated = $request->validate(['user_id'=>['required','numeric']]);
        $user =  User::find($validated['user_id']);
        if($user){
            $user->givePermission($permission);
        }

        return redirect()->back()->with('success','Permission Assigned Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //
        return view('permissions.edit',['permission'=>$permission]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
