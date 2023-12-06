<x-layout>
      
        
    <div class="container-fluid">
            <div class="dashboard-container">

                {{-- Each Whole Table Screen --}}
                <div class="process-bar">
                    <div class="process-bar">
                       

                        {{-- Attendance Table --}}
                        <div class="pre-scrollable" >

                                <div class="card-body">
                                        <table class="table table-striped table-bordered">
                                            {{-- Table Head --}}
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Last Altered By</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            {{-- Table Body --}}
                                            <tbody class="search_result">
                                                {{-- System Status --}}
                                                <tr>
                                                    <td> {{$system_status->value == 1 ? "Switch System Offline" : "Switch System Online" }}</td>

                                                    <td>{{$system_status->altered_by ? App\Models\User::find($system_status->altered_by)->fullname(): "None" }}</td>

                                                    @if($system_status->value == 1)
                                                        <td class="btn btn-warning fa fa-power-off" data-toggle="modal" data-target="#myModal" data-url="{{route('confirm_system_switch_off')}}" > Turn Off</td>
                                                    @else
                                                        <td class="btn btn-warning fa fa-power-off" data-toggle="modal" data-target="#myModal" data-url="{{route('confirm_system_switch_on')}}" > Turn On</td>
                                                    @endif
                                                   
                                                </tr>

                                            </tbody>
                                            {{-- Table Body Ends --}}
                                        </table>
                                       
                                </div>
                        
                         
                        </div>
                        {{--Users Table Ends--}}

                        {{-- {{$role->links()}} --}}
                       
                    </div>
                </div>
                {{-- Whole Table Screen Ends --}}

               


            </div> <!-- end of dashboard container -->

        </div>
        <!-- /.conainer-fluid -->

</x-layout>