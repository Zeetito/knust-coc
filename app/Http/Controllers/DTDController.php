<?php

namespace App\Http\Controllers;

use App\Models\DTD;
use App\Models\User;
use App\Models\Group;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DTDController extends Controller
{
    //
    // Door To Door For A particular User
    public function user_dtd(User $user){
        return view('DoorToDoor.user-dtd-index',['user'=>$user]);
    }

    // Create Door To Door Form
    public function create(){
        return view('DoorToDoor.create');
    }

    // Show A Door To Door Group
    public function show_dtd_group(Group $group){
        $dtd = $group->groupable;

        if($dtd->type == "fishing_out"){
            return view('DoorToDoor.FishingOut.groups.show',['group'=>$group,'dtd'=>$dtd]);
        }elseif($dtd->type == "evangelism"){
            return "Great Evangelism";
        }elseif($dtd->type == "visitation"){
            return "Great Visitation";
        }
    }

    // Confrim Delete
    public function confirm_delete(DTD $dtd){
        return view('DoorToDoor.delete',['dtd'=>$dtd]);
    }

    // Delete DTD Session
    public function delete(Request $request, DTD $dtd){
        $validated = $request->validate([
            'response'=>['required','numeric'],
        ]);
        if ($validated['response'] == 1){

            if($dtd->groups->count() > 0){
                $dtd->groups->each->delete();
            }
            $dtd->delete();
            return redirect()->back()->with('warning','Session Deleted!');


        }else{
            return redirect()->back()->with('failure','Select A Valid Response');
        }
    }

    // View User Groups - Modal
    public function groups(DTD $dtd){
        return view('DoorToDoor.groups.index',['dtd'=>$dtd]);
    }

    // View All Users - Modal
    public function users(DTD $dtd){
        return view('DoorToDoor.user.index',['dtd'=>$dtd]);
    }

    // Create A Door To Door Record Instance
    public function create_record(Group $group){
        $dtd = $group->groupable;

        if($dtd->type == "fishing_out"){
            // Check if the target is a zone or residence
            if($dtd->is_zone == 0){
                return view('DoorToDoor.FishingOut.groups.create-record-residence',['group'=>$group,'dtd'=>$dtd]);
            }else{
                return view('DoorToDoor.FishingOut.groups.create-record-zone',['group'=>$group,'dtd'=>$dtd]);

            }

        }elseif($dtd->type == "evangelism"){
            return "Great Evangelism";
        }elseif($dtd->type == "visitation"){
            return "Great Visitation";
        }
    }

    // Edit A DTD Record Instance
    public function edit_record($record_id){
        $record = DB::table('dtd_persons')->where('id',$record_id)->first();
        // the View to be returned would be based on whether or not the dtd session is_zone or not
        $is_zone = DTD::find($record->d_t_d_s_id)->is_zone;
        if($is_zone == 1 ){
            return "Aden";
        }else{
            return view('DoorToDoor\FishingOut\groups\edit-record-residence',['record'=>$record]);
        }

    }

    // Update Record
    public function update_record(Request $request, $record_id){
        $validated = $request->validate([
            'name' => ['nullable'],
            'residence_id'=>['required','numeric'],
            'room'=>['nullable'],
            'floor'=>['nullable'],
            'info'=>['nullable'],
            'success'=>['required'],
        ]);

        $validated['updated_at'] = now();
        $record = DB::table('dtd_persons')->where('id',$record_id);
        $record->update($validated);

        return redirect()->back()->with('success','Update Successful');

    }


    // Store Door To Door Record Instance
    public function store_record(Group $group, Request $request){
        $dtd = $group->groupable;
        $validated = $request->validate([
            'name' => ['nullable'],
            'residence_id'=>['required','numeric'],
            'room'=>['nullable'],
            'floor'=>['nullable'],
            'info'=>['nullable'],
            'success'=>['required'],
        ]);
        $validated['d_t_d_s_id'] = $dtd->id;
        $validated['group_id'] = $group->id;
        $validated['created_at'] = now();
        $validated['updated_at'] = now();

        if($dtd->type == "fishing_out"){
            DB::table('dtd_persons')->insert($validated);
        }elseif($dtd->type == "evangelism"){
            return "Great Evangelism";
        }elseif($dtd->type == "visitation"){
            return "Great Visitation";
        }

        return redirect(route('show_dtd_group',['group'=>$group]))->with('success','New Record Created');

    }

    // FISHING OUT
    // Create A fishing out session
    public function fishing_out_create(){
        return view('DoorToDoor\FishingOut\create');
    }

    // Store DTD Sessoin
    public function store(Request $request){
        $validated = $request->validate([
            'name'=>['required','min:4'],
            'type'=>['required'],
            'residence_id'=>['nullable'],
            'zone_id'=>['nullable'],
            'info'=>['nullable'],
            'is_zone'=>['required','numeric'],
        ]);

        // Check if target is a zone or residence
        if($validated['is_zone'] == 1){
            $validated['location_id'] = $validated['zone_id'];
        }else{
            $validated['location_id'] = $validated['residence_id'];
        }
        $validated['created_by'] = auth()->user()->id;
        $validated['academic_year_id'] = Semester::active_semester()->academicYear->id;

        unset($validated['residence_id']);
        unset($validated['zone_id']);

        $dtd = DTD::create($validated);

        // // Create A General Group for this session
        // $group = new Group;
        // $group['name'] ="Group A -- ".$dtd->name;
        // $group['groupable_id'] = $dtd->id;
        // $group['groupable_type'] = "App\Models\DTD";
        // $group['created_by'] = auth()->user()->id;
        // $group['visibility'] = 1;
        // $group['target'] = 'guests';
        // $group['academic_year_id'] = Semester::active_semester()->academicYear->id;
        // $group->save();
        
        // Create A Group_User Instance between the creator and the group
        // DB::table('group_users')->insert([
        //     'group_id'=>$group->id,
        //     'user_id'=>auth()->user()->id,
        //     'created_by'=>auth()->user()->id,
        //     'is_member'=>1,
        //     'is_admin'=>1,
        //     'created_at' =>now(),
        //     'updated_at' =>now(),
        // ]);

        return redirect()->back()->with('success','Door To Door Session Created');
    }

    // Door To Door Subgroup Create
    public function dtd_subgroup_create(DTD $dtd, Request $request){
        return view('DoorToDoor.groups.create',['dtd'=>$dtd]);
    }

    // Door To Door Group Store
    public function dtd_subgroup_store(DTD $dtd, Request $request){
        $validated = $request->validate([
            'name'=>['required'],
            'info'=>['nullable'],
        ]);
        $validated['info'];
        $validated['name'] = $validated['name']." -- ".$dtd->name;
        $validated['groupable_id'] = $dtd->id;
        $validated['groupable_type'] = "App\Models\DTD";
        $validated['created_by'] = auth()->user()->id;
        $validated['visibility'] = $dtd->visibility;
        $validated['academic_year_id'] = $dtd->academic_year_id;

        $group = Group::Create($validated);

         // Create A Group_User Instance between the creator and the group
         DB::table('group_users')->insert([
            'group_id'=>$group->id,
            'user_id'=>auth()->user()->id,
            'created_by'=>auth()->user()->id,
            'is_member'=>1,
            'is_admin'=>1,
            'created_at' =>now(),
            'updated_at' =>now(),
        ]);

        return redirect(route('show_group',['group'=>$group]))->with('success','SubGroup Created');

    }



}
