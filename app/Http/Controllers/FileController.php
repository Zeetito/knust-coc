<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //

    // View All files uploaded by a model instance
    public function view_files($uploadable_type,$uploadable_id){
        
        $uploadable = ($uploadable_type)::where('id',$uploadable_id)->first();


        return view('files.index',['uploadable'=>$uploadable, 'uploadable_type'=>$uploadable_type, 'uploadable_id'=>$uploadable_id]);
    }

    // Upload File Form
    public function upload_file_form($uploadable_type,$uploadable_id,$type){
        $uploadable = ($uploadable_type)::where('id',$uploadable_id)->first();
        return view('files.upload',['uploadable'=>$uploadable, 'uploadable_type'=>$uploadable_type, 'uploadable_id'=>$uploadable_id, 'type'=>$type]);
    }

    // Upload File
    public function upload_file(Request $request){
        
        $request->validate([
            'file' => 'required|max:10240', // PDF validation
        ]);

    
        $file = $request->file('file');
        // $file_name = time() . '.' . $file->getClientOriginalName();
        $file_name = $file->getClientOriginalName();

        // return $file_name;

        $path = 'storage/app/public/files/pdfs/';

        $instance = new File;
        $instance['name'] = $file_name;
        $instance['url'] = time().'.'.$file->getClientOriginalExtension();
        $instance['uploadable_id'] = $request->input('uploadable_id');
        $instance['uploadable_type'] = $request->input('uploadable_type');
        $instance['type'] = $request->input('type');
        $instance['semester_id'] = Semester::active_semester()->id;
        $instance['created_at'] = now();
        $instance['updated_at'] = now();

        // return $instance;
    
        // Store the file
        // Storage::put($path, file_get_contents($file));
        $file->move($path , $instance['url']);
        // if($stored){
            $instance->save();
            return redirect()->back()->with('success', 'File Uploaded');
        // }else{
            // return redirect()->back()->with('failure', 'Failed to Upload file');
        // }
    


    }
}
