<x-guest_layout>
        
    <div class="card">
            <div class="">

                <div class="card-header">
                    {{$special_program_residence->name}}
                </div>

                <div class="card-body">
                
                
                    <div class="row m-1">
                        {{-- Participants --}}
                        <div class="rounded border border-solid border-secondary p-3 col-12">
                            <div class="float-end fa fa-user-plus btn border border-solid" data-url="{{route('create_special_program_residence_participant',['special_program_residence'=>$special_program_residence->id])}}" data-target="#myModal" data-toggle="modal"></div>
                            <h5 class="text-center card-title">Participants Details</h5>

                            @if($special_program_residence->participants->count() >0)
                                
                                <div class="table-responsive">

                                    <table class="table table-bordered table-striped datatable ">
                                        <thead>
                                            <th>Name</th>
                                            <th>Residence</th>
                                            <th>Room</th>
                                            <th>Gender</th>
                                        </thead>

                                        <tbody>
                                            @foreach($special_program_residence->participants as $participant)
                                                <tr>
                                                    <td>{{$participant->firstname." ".$participant->lastname}}</td>
                                                    <td>{{$participant->residence->name}}</td>
                                                    <td>{{$participant->room->name}}</td>
                                                    <td>{{$participant->gender}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
    
                                    </table>

                                </div>
                                @foreach($special_program_residence->participants as $participant)

                                @endforeach
                            @else
                                <div class="h5 text-center">No Participants To Show</div>
                            @endif
    
                        </div>


                        {{-- Rooms --}}
                        <div class="rounded border border-solid border-secondary p-3 col-12 mt-2">
                            <div class="float-end fa fa-plus-square btn border border-solid" data-url="{{route('create_special_program_residence_room',$special_program_residence->id)}}" data-target="#myModal" data-toggle="modal"></div>
                            <h5 class="text-center card-title">Room Details</h5>

                            @if($special_program_residence->rooms->count() >0)
                                @foreach($special_program_residence->rooms as $room)

                                @endforeach
                                <div class="table-responsive ">
                                    <table class="table table-bordered table-striped datatable ">
                                        <thead>
                                            <th>Name</th>
                                            <th>No Occupied</th>
                                            <th>Size</th>
                                            <th>Floor</th>
                                            <th>Gender</th>
                                            <th>Action</th>
                                        </thead>

                                        <tbody>
                                            @foreach($special_program_residence->rooms as $room)
                                                <tr>
                                                    <td>{{$room->name}}</td>
                                                    <td>{{$room->participants->count()}}</td>
                                                    <td>{{$room->size}}</td>
                                                    <td>{{$room->floor}}</td>
                                                    <td>{{ $room->gender ? ($room->gender == 'm' ? 'Male' : 'Female') : '' }}</td>
                                                    <td>
                                                        <a href="#" class="mr-2 fa fa-eye"></a>
                                                        <a href="#" class="mr-2 fa fa-pencil"></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            @else
                                <div class="h5 text-center">No Rooms To Show</div>
                            @endif
    
                        </div>

                       
                    </div>

                </div>


            </div>



            </div> <!-- end of dashboard container -->

        </div>
        <!-- /.conainer-fluid -->

</x-guest_layout>