<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\AccountRecord;

class AccountRecordController extends Controller
{
    //

    // Create Minsitry Account Record
    public function create_ministry_account_record(Account $account){
        return view('ADMIN.dashboard.components.ministries.accounts.records.create',['account'=>$account]);
    }

    // Store Ministry Account Record
    public function store_ministry_account_record(Request $request, Account $account){

        $validated = $request->validate([
            'item'=>['required'],
            'info'=>['nullable'],
            'value'=>['required','numeric'],
            'account_id'=>['required'],
        ]);
        $validated['created_by'] = auth()->id();

        AccountRecord::create($validated);

        return redirect()->back()->with('success','New Record Created Successfully');

    }

    // Edit Account Record 
    public function edit_account_record(AccountRecord $record){
        return view('ADMIN.dashboard.components.ministries.accounts.records.edit',['record'=>$record]);
    }

    // Update Account Record
    public function update_account_record(Request $request, AccountRecord $record){
        $validated = $request->validate([
            'item'=>['required'],
            'info'=>['nullable'],
            'value'=>['required','numeric'],
        ]);

        $record->update($validated);
        return redirect()->back()->with('success','Record Updated Successfully');

    }

    // Delete Account Record
    public function confirm_delete_account_record(AccountRecord $record){
        return view('ADMIN.dashboard.components.ministries.accounts.records.delete',['record'=>$record]);
    }

    public function delete_account_record(Request $request, AccountRecord $record){

        $record->delete();
        return redirect()->back()->with('warning','Record Deleted!');


    }

}
