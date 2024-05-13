<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

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

    // Users without biodata
    public function without_biodata(){
        return UserResource::collection(User::without_biodata()->get());
    }

    // Unavailable Members
    public function unavailable_members(){
        return UserResource::collection(User::unavailable_members()->get());
    }

    // mark member unavaiable
    public function mark_unavailable(User $user, Request $request){

        if($user->is_available == 1){
            $validated = $request->validate([
                'is_available' => ['required', 'numeric'],
                'category'=> ['required'],
                'info' => ['min:5','required']
            ]);
                $validated['user_id'] = $user->id;
                $validated['recorded_by'] = auth()->user()->id;
                unset($validated['is_available']);
            DB::table('unavailable_members')->insert($validated);

            $user->is_available = 0;
            $user->save();

        }else{

            DB::table('unavailable_members')->where('id',$user->unavailable_member_instance->id)->delete();
            $user->is_available = 1;
            $user->save();
        }
    }


}
