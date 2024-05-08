<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Remark;
use App\Models\Semester;
use Illuminate\Http\Request;

class RemarkController extends Controller
{
    //

    public function semester_sort(Role $ministry){
        return view('ADMIN.dashboard.components.ministries.remarks.semester-sort',['ministry'=>$ministry]);
    }

    // Select remark type
    public function select_remark_type($model_type, $remarkerable_id){
        $remarkerable_type = "App\\Models\\".$model_type;

        return view('remarks.type-select',['remarkerable_type'=>$remarkerable_type, 'remarkerable_id'=>$remarkerable_id, 'model_type'=>$model_type]);
    }

    // Create
    // public function create(Request $request){
    //     return view('remarks.create',['form_data'=>$request->all()]);
    // }


    // ---------

    // Create User Remark
    public function create($remarkerable_type, $remarkerable_id, $remarkable_id, $remarkable_type){
        $remarkable = ($remarkable_type)::find($remarkable_id);
        $remarkerable = ($remarkerable_type)::find($remarkerable_id);

        return view('remarks.create',['remarkable'=>$remarkable, 'remarkerable'=>$remarkerable, 'remarkable_type'=>$remarkable_type, 'remarkerable_type'=>$remarkerable_type]);

    }

    // Store remark
    public function store(Request $request, $remarkerable_type, $remarkerable_id, $remarkable_id, $remarkable_type){
            $validated = $request->validate([
                'body'=>['required'], 
            ]);


            $remarkable = ($remarkable_type)::find($remarkable_id);
            $remarkerable = ($remarkerable_type)::find($remarkerable_id);

            $remark = $remarkable->remark_from($remarkerable_type, $remarkerable->id, Semester::active_semester()->id);

            if($remark){
                $remark->body = $validated['body'];
            }else{
                $remark = new Remark;
                $remark->remarkable_id = $remarkable->id;
                $remark->remarkable_type = $remarkable_type;
                $remark->remarkerable_id = $remarkerable->id;
                $remark->remarkerable_type = $remarkerable_type;
                $remark->body = $validated['body'];
                $remark->semester_id = Semester::active_semester()->id;
            }


            $remark->save();

            return redirect()->back()->with('success','Success');
    }

    // Confrim delete
    public function confirm_delete(Remark $remark){
        if($remark){
            return view('remarks.delete',['remark'=>$remark]);
        }
    }

    // Delete
    public function delete(Remark $remark){
        if($remark){
            $remark->delete();

            return redirect()->back()->with('warning','Deleted');
        }
    }


    // ---------
}
