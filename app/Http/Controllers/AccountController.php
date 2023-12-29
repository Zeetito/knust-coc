<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Account;
use App\Models\Semester;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //

    // Create Minsitry Account Session - Modal
    public function create_ministry_account_session(Role $ministry){
        return view('ADMIN.dashboard.components.ministries.accounts.create',['ministry'=>$ministry]);
    }

    // Store Minsitry Account Session
    public function store_ministry_account_session(Role $ministry, Request $request){
        $validated = $request->validate([
            'name'=>['required'],
            'accountable_id'=>['required','numeric'],
            'accountable_type'=>['required'],
            'type'=>['required'],
        ]);

        $validated['created_by'] = auth()->id();
        $validated['semester_id'] = Semester::active_semester()->id;

       Account::create($validated);
       return redirect()->back()->with('success','Account Session Created Successfully');
    }

    // Show Ministry Account Session
    public function show_ministry_account_session(Role $ministry, Account $account){
        return view('ADMIN.dashboard.components.ministries.accounts.show',['ministry'=>$ministry, 'account'=>$account]);
    }

    // confirm_delete_ministry_account_session
    public function confirm_delete_ministry_account_session(Account $account){
        return view('ADMIN.dashboard.components.ministries.accounts.delete',['account'=>$account]);
    }

    public function delete_ministry_account_session(Request $request,Account $account){
        if($request->input('response') == '1' ){
            $account->delete();
            return redirect()->back()->with('warning','Session Deleted!');
            
        }else{
            return redirect()->back()->with('warning','Input A valid response');
        }
    }
}
