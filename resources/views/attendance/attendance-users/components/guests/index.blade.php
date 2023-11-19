<x-layout>
      
        
    <div class="container-fluid">
            <div class="dashboard-container">

                {{-- Each Whole Table Screen --}}
                <div class="process-bar">
                    <div class="process-bar">
                        <div class="process-order">
                            <a href="{{route('show_attendance_users',['attendance'=>$attendance])}}">
                                <h3 style="text-align:center"> Attendance Session: {{$attendance->semesterProgram->name." - ".$attendance->semesterProgram->created_at->format('Y-M-d-D')}}</h3>
                                <i class="fa fa-eye"></i>
                            </a>

                            {{-- Search Box --}}
                            {{-- <span>
                                <form >
                                    <input  type="text" id="for_user_list" class="search_box" data-url="{{route("search_absentees",['attendance'=>$attendance] )}}" placeholder="search name..." style="text-align:center;">
                                        <i class="fa fa-search"></i>
                                </form>
                            </span> --}}

                         

                        </div>

                        {{-- Attendance Table --}}
                        {{-- Visitors Table --}}
                        <div class="pre-scrollable" >

                            <div class="card-body">
                                    <h5>Visitors</h5>
                                    <table class="table table-striped">
                                        
                                        {{-- Table Head --}}
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Church</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        {{-- Table Body --}}
                                        <tbody id="search_result_for_user_visitors_list">

                                                {{-- For users Visitors --}}
                                            @foreach($attendance->users_visitors_present() as $member)
                                                <tr id="tr_{{$member->id}}">
                                                    <td><i class=" text-success fa fa-check"></i>{{$member->fullname()}}</td>
                                                    <td>{{$member->biodata == null ? "" : $member->local_congregation()}}</td>
                                                    <td>
                                                            {{-- Check User Button --}}
                                                            <button class="btn" data-toggle ="modal" data-target="#myModal" id="{{"user_visitor_".$member->id}}"  data-url="{{route('confirm_uncheck_user',['attendance'=>$attendance , 'user'=>$member->person_id])}}" >
                                                                    <i class=" text-danger fa fa-times"></i>
                                                            </button>                                                        
                                                    </td>
                                                    {{-- <td>
                                                        <span class="badge badge-success">Active</span>
                                                    </td> --}}
                                                </tr>
                                            @endforeach

                                            {{-- For Guest Visitors --}}
                                            @foreach($attendance->guests_present() as $guest)
                                                <tr id="tr_{{$guest->id}}">
                                                    <td>{{$guest->fullname}}</td>
                                                    <td>{{$guest->local_congregation}}</td>
                                                    <td>
                                                            {{-- Check User Button --}}
                                                            <button class="btn" data-toggle ="modal" data-target="#myModal" id="{{"guest_".$guest->id}}" data-url="{{route('confirm_uncheck_guest',['attendance'=>$attendance , 'guest'=>$guest->person_id])}}" >
                                                                    <i class=" text-danger fa fa-times"></i>
                                                            </button>                                                        
                                                    </td>
                                                    {{-- <td>
                                                        <span class="badge badge-success">Active</span>
                                                    </td> --}}
                                                </tr>
                                            @endforeach

                                        </tbody>
                                        {{-- Table Body Ends --}}
                                    </table>
                                    
                            </div>
                    
                        </div>
                    {{-- Visitors Table Ends --}}
                        {{--Scrollable Table Ends--}}

                        {{-- {{$absentees->links()}} --}}
                       
                    </div>
                </div>
                {{-- Whole Table Screen Ends --}}
                {{-- Visitors Table Ends --}}

            </div> <!-- end of dashboard container -->

        </div>
        <!-- /.conainer-fluid -->

</x-layout>