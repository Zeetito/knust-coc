<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Models\Semester;
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
    public function account_sessions(Role $ministry, Semester $semester){
        // if($ministry->slug == "welfare_ministry_member"){
            return view('ADMIN.dashboard.components.ministries.space.accounts',['ministry'=>$ministry, 'semester'=>$semester]);
        // }
    }

    // View relates semesters
    public function account_sessions_semesters(Role $ministry){
        return view('ADMIN.dashboard.components.ministries.accounts.semester-sort',['ministry'=>$ministry]);
    }

    // View Ministry Shared Items
    public function received_items(Role $ministry){
        return view('ADMIN.dashboard.components.ministries.space.shared-items',['ministry'=>$ministry]);
    }

    // Ministry remark session
    public function ministry_remark_session(Role $ministry, Semester $semester){
        return view('ADMIN.dashboard.components.ministries.remarks.index',['ministry'=>$ministry, 'semester'=>$semester]);
    }

}
