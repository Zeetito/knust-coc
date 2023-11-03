<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    // This is just a test but maybe later could implement a process
    // where an admin could create an account for someone
    public function store(UserRequest $request)
    {
        $user = User::create($request->validated());

        return new UserResource($user);
    }

    // Index
    public function index()
    {
        return UserResource::collection(User::paginate());
    }

    // Show
    public function show(User $user)
    {
        return new UserResource(User::findOrFail($user->id));

        // return UserResource::collection(User::paginate());
    }
}
