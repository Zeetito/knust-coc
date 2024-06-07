<x-layout>


    <div class="card-body bg-white">

        <a href="{{route('remarks_semester_sort',['ministry'=>$ministry])}}" class="btn-secondary btn float-right">Go Back</a>

        <div class="h6 " >
            {{$ministry->name}} - Remarks/Notes - {{$semester->academic_name()}}

            {{-- <span data-toggle="modal" data-target="#myModal" data-url="{{route('select_remark_create',['model_type'=>'Role', 'remarkerable_id'=>$ministry->id])}}" class="btn btn-info m-2">Add Remarks</span> --}}

        </div>

        <div class="row nav">

            {{-- @foreach(App\Models\Semester::all()->sortDesc() as $semester) --}}

                @if($ministry->has_remarks_for($semester))

                
                <div class="table-responsive">
                    
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                {{-- <th>Note</th> --}}
                                <th>Created On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach($ministry->remarks_for($semester) as $remark)
                                <tr>
                                    <td>{{$remark->remarkable->fullname() ? $remark->remarkable->fullname() : $remark->remarkable->name}}</td>
                                    {{-- <td>{{$remark->body}}</td> --}}
                                    <td>{{$remark->created_at}}</td>
                                    <td>
                                        <a href="{{route('view_remarks',['remarkable_type'=>'App\\Models\User','remarkable_id'=>$remark->remarkable->id, 'remarkerable_type'=>'App\\Models\\Role', 'remarkerable_id'=>$ministry->id])}}" class="mr-2 fa fa-eye"></a>
                                        {{-- <i  data-toggle="modal" data-target="#myModal" data-url = "{{route('confirm_delete_remark',['remark'=>$remark])}}" class="fa fa-trash"></i> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                      
            
                        </div>


                @endif

            {{-- @endforeach --}}
                       
        </div>

    </div>

</x-layout>