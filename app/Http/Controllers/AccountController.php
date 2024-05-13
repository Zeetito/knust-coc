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
    public function show_ministry_account_session(Account $account){
        // return $semester;
        return view('ADMIN.dashboard.components.ministries.accounts.show',['ministry'=>$account->ministry, 'account'=>$account, 'semester'=>$account->semester]);
    }

    // edit Ministry Account Session
    public function edit_ministry_account_session(Role $ministry, Account $account){
        return view('ADMIN.dashboard.components.ministries.accounts.edit',['ministry'=>$ministry, 'account'=>$account]);
    }

    // Update Minsitry Account Session
    public function update_ministry_account_session(Request $request,Account $account){
        $validated = $request->validate([
            'name'=>['required'],
        ]);

        $validated['updated_at'] = now();
       $account->update($validated);
       return redirect()->back()->with('success','Account Session Updated!');
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

    // create Share instance
    public function create_share(Account $account, Role $ministry, Semester $semester, $sendable, ){
        return view('ADMIN.dashboard.components.ministries.accounts.share',['account'=>$account,  'sharable_type'=>'App\Models\Account' , 'ministry'=>$ministry, 'semester'=>$semester, 'sendable_type'=>$sendable]);
    }
}
