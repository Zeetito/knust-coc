<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    // This is just a test but maybe later could implement a process
    // where an admin could create an account for someone
    public function store(UserRequest $request){
        $user = User::create($request->validated());

        return new UserResource($user);
    }
        public function index(){
        return UserResource::collection(User::paginate());
    }
}
