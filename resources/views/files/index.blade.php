<x-layout>

    <div class="card-body bg-white">

        Files Uploaded by <strong>{{$uploadable->name ? $uploadable->name:$uploadable->fullname()}}</strong>
        
        @if($uploadable->files == "[]")
        <div class="card">
            No Files Uploaded
            {{-- <a href="{{route('upload_file',['type'=>'pdf'])}}" class="float-right btn btn-info mt-2">Upload PDF</a> --}}
            <span data-toggle="modal" data-target="#myModal" data-url="{{route('upload_file_form',['uploadable_type'=>$uploadable_type, 'uploadable_id'=>$uploadable_id ,'type'=>'pdf'])}}" class="btn btn-info mt-2">Upload PDF</span>
        </div>
        @else
        <div>
            There You go
        </div>
        @endif

    </div>

</x-layout>