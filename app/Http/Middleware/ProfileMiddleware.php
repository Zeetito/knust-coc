<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        $residence = $user->residence();
        $program = $user->program();

        if($user->is_member==1){

            // All members Must have  A profile and A zone

            // A student must definitely have a program of study
            if($user->is_student == 1){
                if(!$program){
                    return redirect(route('create_user_program',['user'=>$user]));
                }
            }

            if($user->has_member_profile()){

                if(!$residence){
                    return redirect(route('create_user_residence',['user'=>$user]));
                }
                return $next($request);
                
            }else{
                return redirect(route('create_user_profile_form',['user'=>$user]))->with('warning','You need to Update your profile first.');
            }
        }else{
            if($user->has_alumni_profile()){
                return $next($request);
            }else{
                return redirect(route('create_user_profile_form',['user'=>$user]))->with('warning','You need to Update your profile first.');
            }
        }
        // return $next($request);
    }
}
