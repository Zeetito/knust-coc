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


                                                {{-- Semester --}}
                                                <tr>
                                                    <td>Semester</td>
                                                    
                                                    <td>None</td>
                                                    
                                                    <td class="btn btn-warning fa fa-power-off" >
                                                        Action
                                                        
                                                        <div class="menu-container">
                                                            <button class="menu-button">&#8286;</button>
                                                            <div class="menu-content">

                                                              <span  data-toggle='modal' data-target="#myModal" data-url="{{route('create_new_semester')}}" class="bg-info btn mt-1">Start New</span>
                                                              {{-- <span  data-toggle='modal' data-target="#myModal" data-url="{{route('delete_current_academic_year')}}" class="bg-info btn mt-1">Delete Current</span> --}}

                                                            </div>
                                                        </div>

                                                    </td>

                                                </tr>


                                                {{-- Academic Year  --}}
                                                <tr>
                                                    <td>Academic Year</td>
                                                    
                                                    <td>None</td>
                                                    
                                                    <td class="btn btn-warning fa fa-power-off" >
                                                        Action
                                                        
                                                        <div class="menu-container">
                                                            <button class="menu-button">&#8286;</button>
                                                            <div class="menu-content">

                                                              {{-- <a class="bg-warning btn mt-1" data-toggle='modal' data-target="#myModal"  >Deactivate User</a> --}}
                                                              <span  data-toggle='modal' data-target="#myModal" data-url="{{route('create_new_academic_year')}}" class="bg-info btn mt-1">Start New</span>
                                                              <span  data-toggle='modal' data-target="#myModal" data-url="{{route('delete_current_academic_year')}}" class="bg-info btn mt-1">Delete Current</span>

                                                            </div>
                                                        </div>

                                                    </td>

                                                </tr>

                                                {{-- Remind Users with no profile  --}}
                                                <tr>
                                                    <td>Reminder - Users with no profile </td>
                                                    
                                                    <td>
                                                        This Sends an email to all users who do not have a profile,
                                                        to do so if the last time they were reminded is over 2 Days.
                                                        Currently there are <strong>{{App\Models\User::without_biodata()->where('updated_at' ,'<',(Carbon\Carbon::now()->subDays(1)))->get()->count()}}</strong>
                                                        Members in this class of users.
                                                    </td>
                                                    
                                                    <td class="btn btn-warning fa fa-send" >
                                                        <a class="bg-warning btn mt-1" href="{{route('emails_to_all_users_without_biodata')}}" >Send Emails</a>
                                                    </td>

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