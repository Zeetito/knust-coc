<?php

namespace App\Http\Controllers;

use App\Models\Share;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    //

    // Show shared Item
    public function show(Share $item){
        $type = $item->sharable_type;

        if($type == "App\Models\Account"){
            return redirect(route('show_ministry_account_session',['account'=>$item->sharable]));
        }
    }


    // Store
    public function store(Request $request){

        $sharable_id = $request->input('sharable_id');
        $sharable_type = $request->input('sharable_type');
        $sendable_id = $request->input('sendable_id');
        $sendable_type = $request->input('sendable_type');

        // With Users
        if($request->input('users')){
            $validated = $request->validate([
                'users'=>'array',
            ]);
            $users_id = $validated['users'];

            foreach($users_id as $user_id){
                $share = new Share;
                $share['sharable_id'] = $sharable_id;
                $share['sharable_type'] = $sharable_type;
                $share['sendable_id'] = $sendable_id;
                $share['sendable_type'] = $sendable_type;
                $share['receivable_id'] = $user_id;
                $share['receivable_type'] = 'App\Models\User';
                $share['shared_by'] = auth()->id();
                $share->save();
            }
        }

        // With Ministries
        if($request->input('ministry')){
            $validated = $request->validate([
                'ministry'=>'array',
            ]);  

            $ministries_id = $validated['ministry'];
            foreach($ministries_id as $ministry_id){
                $share = new Share;
                $share['sharable_id'] = $sharable_id;
                $share['sharable_type'] = $sharable_type;
                $share['sendable_id'] = $sendable_id;
                $share['sendable_type'] = $sendable_type;
                $share['receivable_id'] = $ministry_id;
                $share['receivable_type'] = 'App\Models\Role';
                $share['shared_by'] = auth()->id();
                $share->save();

            }

        }

        return redirect(route('home'))->with('success','Shared!');
        


    }

    // Confrim Cancel
    public function confirm_cancel(Share $item){
        return view('shares.cancel',['item'=>$item]);
    }

    // Cancel Share
    public function cancel(Share $item , Request $request){
        if($request->input('response') == 1 ){
            if($item){
                $item->delete();
            return redirect()->back()->with('warning','Share Cancelled!');

            }
        }else{
            return redirect()->back()->with('failure','Enter Valid response');
        }
    }


}
