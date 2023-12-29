<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MinistrySpaceController extends Controller
{
    //
    // WELFARE MINISTRY
    // landingPage
    public function ministry_index(Role $ministry){
        return view('ADMIN.dashboard.components.ministries.space.index',['ministry'=>$ministry]);
        
    }

    // View Accounts Sessions For A Ministry
    public function account_sessions(Role $ministry){
        // if($ministry->slug == "welfare_ministry_member"){
            return view('ADMIN.dashboard.components.ministries.space.accounts',['ministry'=>$ministry]);
        // }
    }

}
