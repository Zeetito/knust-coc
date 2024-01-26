<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Semester;
use App\Models\Accessory;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Mail\CreateBiodataMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

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


    // ACADEMIC YEAR
    // Create New Academic Year
    public function create_new_academic_year(){
        $current_year = Semester::active_semester()->academicYear;
        return view('ADMIN.configurations.academic-year.create',['current_year'=>$current_year]);
    }

    // Store New Academic Year
    public function store_new_academic_year(Request $request){
        $current_year = Semester::active_semester()->academicYear;
        $validated = $request->validate([
            'start_year' =>['required'],
            'end_year' =>['required'],
        ]);

        AcademicYear::create($validated);
        $sem =  new Semester;
        $sem[''];

    }

    // Emails to all users without biodata
    public function emails_to_all_users_without_biodata(){

        //  =  User::without_biodata()->get();

        $OneDayAgo = Carbon::now()->subDays(1);

        $users = User::without_biodata()->where('updated_at' ,'<',$OneDayAgo)->get();

        if(auth()->user()->is_ministry_member()){

            if($users->count() == 0){
                    return redirect()->back()->with('warning','All Users withtout Biodata have been notified not more than 24hours ago');
            }

            foreach($users as $user){
                    Mail::to($user->email)->send(new CreateBiodataMail($user));
                    $user->updated_at = now();
                    $user->save();
            }
    
        }
        return redirect()->back()->with('success','Members Notified');

    }
    
}
