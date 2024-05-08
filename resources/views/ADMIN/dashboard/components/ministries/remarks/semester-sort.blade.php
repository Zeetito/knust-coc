<x-layout>


    <div class="card-body bg-white">

        <a href="{{route('ministry_index',['ministry'=>$ministry])}}" class="btn-secondary btn float-right">Go Back</a>

        <div class="h6 " >
            {{$ministry->name}} Remarks/Notes...

            {{-- <span data-toggle="modal" data-target="#myModal" data-url="{{route('select_remark_create',['model_type'=>'Role', 'remarkerable_id'=>$ministry->id])}}" class="btn btn-info m-2">Add Remarks</span> --}}

        </div>

        <div class="row nav">

            @foreach(App\Models\Semester::all()->sortDesc() as $semester)

                @if($ministry->has_remarks_for($semester))

                    <div class="col-4">

                        <a href="{{route('ministry_remark_session',['ministry'=>$ministry,'semester'=>$semester])}}">
                            <img class="list-folder" src="{{asset('img/folder.png')}}" alt="folder">
                            
                            <div>{{$semester->academicYear->name()." - Sem ".$semester->name}}</div>
                        </a>
        
                    </div>

                @endif

            @endforeach
                       
        </div>

    </div>

</x-layout>