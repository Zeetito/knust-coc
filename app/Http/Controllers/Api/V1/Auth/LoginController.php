<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    // public function __invoke(LoginRequest $request)
    // {
    //     //

    //     $user = User::where('username',$request->username)->first();

    //     if(!$user || ! Hash::check($request->password, $user->password)){
    //         return response()->json([
    //             'error' => 'Password or Username Incorrect',
    //         ],  status:422);
    //     }

    //     $device = substr($request->userAgent() ?? '', offset:0, length:255);

    //     return response()->json([
    //         'access_token' => $user->createToken($device)->plainTextToken,
    //     ]);

    // }
    public function login(LoginRequest $request)
    {
        //

        $user = User::where('username', $request->username)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'Password or Username Incorrect',
            ], status: 422);
        }

        $device = substr($request->userAgent() ?? '', offset: 0, length: 255);

        return response()->json([
            'access_token' => $user->createToken($device)->plainTextToken,
        ]);

    }
}
