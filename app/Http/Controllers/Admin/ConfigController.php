<?php

namespace App\Http\Controllers\Admin;

use App\Models\Accessory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    //
    // Index
    public function index(){
        return view('ADMIN.configurations.index',['system_status'=>Accessory::getSystemStatus()]);
    }

    // Confirm System Switch Online
    public function confirm_system_switch_on(){
        return view('ADMIN.configurations.system-status.confirm-switch-on');
    }

    // Confirm System Switch Online
    public function confirm_system_switch_off(){
        return view('ADMIN.configurations.system-status.confirm-switch-off');
    }

    // Switch System Online
    public function switch_system_online(Request $request){
        $validated = $request->validate(['response'=>['required','numeric']]);
        if($validated['response'] == 1){
            $accessory = Accessory::where('name', 'system_online')->first();
            $accessory->value = 1;
            $accessory->altered_by =  auth()->user()->id;
            $accessory->save();
        return redirect()->back()->with('success','You have succesffully turned on the System');
        }
    }

    // Switch System offline
    public function switch_system_offline(Request $request){
        $validated = $request->validate(['response'=>['required','numeric']]);
        if($validated['response'] == 1){
            $accessory = Accessory::where('name', 'system_online')->first();
            $accessory->value = 0;
            $accessory->altered_by =  auth()->user()->id;
            $accessory->save();
        return redirect()->back()->with('warning','You have succesffully turned off the System');
        }
    }
    
}
