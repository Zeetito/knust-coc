<x-layout>
        
    <div class="card">
            <div class="">

                <div class="card-header">
                    All Paricipants - {{$special_program->name}}

                    <a href="{{route('create_special_program_participant',['special_program'=>$special_program->id])}}" class="float-end btn btn-info">
                        Create Participant(s)
                    </a>

                </div>

                <div class="card-body">
                       <div class="table-responsive">
                            <table class="table table-bordered table-striped datatable ">
                                <thead>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Congregation</th>
                                    <th>Actions</th>
                                </thead>

                                <tbody>
                                    @foreach($special_program->participants as $participant)
                                        <tr>
                                            <td>{{$participant->firstname." ".$participant->lastname}}</td>
                                            <td>{{$participant->gender}}</td>
                                            <td>{{$participant->congregation}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <span class="fa fa-pencil btn btn-info" data-toggle="modal" data-target="#myModal" data-url="{{route('special_program_participant_edit',['special_program_participant'=>$participant->id])}}"></span>
                                                    {{-- <a href="{{route('special_program_participant_edit',['participant'=>$participant->id])}}" class="btn btn-info">Edit</a> --}}
                                                    {{-- <a href="{{route('special_program_participant_destroy',['participant'=>$participant->id])}}" class="btn btn-danger">Delete</a>       --}}
                                                </div>
                                            </td>
                                    @endforeach
                                </tbody>

                            </table>
                       </div>
                </div>



            </div> <!-- end of dashboard container -->

        </div>
        <!-- /.conainer-fluid -->

</x-layout>