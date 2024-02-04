<x-layout>
      
        
    {{-- <div class="container-fluid"> --}}
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
                            {{-- <span> --}}
                                {{-- <form > --}}
                                    {{-- <input  type="text" id="for_user_list" class="search_box" data-url="{{route("search_absentees",['attendance'=>$attendance] )}}" placeholder="search name..." style="text-align:center;"> --}}
                                        {{-- <i class="fa fa-search"></i> --}}
                                {{-- </form> --}}
                            {{-- </span> --}}

                            {{-- Filter User --}}
                            {{-- <span class=" btn float-right"> --}}
                                {{-- <form method="get" action="{{route('confirm_print_absentees',[ 'attendance'=>$attendance])}}"> --}}
                                    {{-- <select type="text" id="_for_user_list" name="zone" class="filter_box" data-url="{{route('filter_absentees',['attendance'=>$attendance])}}" required>     --}}
                                        {{-- <option value="">Select Zone </option> --}}
                                        {{-- <option value="all">All Zones </option> --}}

                                          {{-- @foreach(App\Models\Zone::all() as $zone) --}}
                                            {{-- <option value="{{$zone->name}}">{{$zone->name}}</option> --}}
                                          {{-- @endforeach --}}
                                      
                                    {{-- </select>         --}}
                                    {{-- <i class="fa fa-filter"></i> --}}
                                    {{--  --}}
                                    {{-- <button type="submit" class="fa fa-print" >Print</button> --}}
                                {{-- </form> --}}
                                @allowedTo(['print_absentees'])
                                {{-- <form class="form-group card-info mt-3">
                                    <select type="text"   required>    
                                            <option value=" " >Print Zone </option>
                                        @foreach(App\Models\Zone::all() as $zone)
                                            <option value="{{$zone->id}}">{{$zone->name}}</option>
                                        @endforeach
                                            <option value="0">All</option>
                                    </select>        
                                    <span type="submit" data-toggle="modal" data-target="#myModal" data-url="{{route('confirm_print_attendance',['attendance'=>$attendance])}}" class="btn fa fa-print">Print</span>                                       
                                </form> --}}
                                @endallowedTo
                            {{-- </span> --}}

                        </div>

                        {{-- Attendance Table --}}
                        {{-- <div class="fit" > --}}

                                <div class="">
                                    <h5>Absentees</h5>
                                        <table class="table datatable_print table-striped">
                                            
                                            {{-- Table Head --}}
                                            <thead>
                                                <tr>
                                                    <th>Member</th>
                                                    <th>Zone</th>
                                                    <th>Reason</th>
                                                    @allowedTo(['update_attendance'])
                                                    <th>Action</th>
                                                    @endallowedTo
                                                </tr>
                                            </thead>
                                            {{-- Table Body --}}
                                            <tbody id="search_result_for_user_list">
                                    

                                                @foreach($absentees as $member)
                                                {{-- {{$user_who_marked = $attendance->user_marked_by($member->pivot->checked_by)}} --}}
                                                <tr  id="tr_{{$member->id}}">
                                                    
                                                    <td>
                                                        <a >
                                                            <img src="{{$member->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                                        </a>
                                                        {{$member->fullname()}}
                                                            @if($member->absentee_status($attendance) == 0 )
                                                                <i class="fa fa-close text-danger"></i>
                                                            @else
                                                                <i class="fa fa-check text-primary"></i>
                                                            
                                                            @endif

                                                    </td>
                                                    
                                                    <td>{{$member->profile_at($attendance->semester->academic_year_id) !=null ? $member->profile_at($attendance->semester->academic_year_id)->zone->name : "No Zone" }}</td>
                                                    
                                                    <td style="word-wrap: break-word;"> {{ $member->absentee_reason($attendance)}} </td>

                                                    @allowedTo(['update_attendance'])
                                                    <td>
                                                        {{-- Check User Button --}}
                                                        <button  id="{{$member->id}}" data-target="#myModal" data-toggle="modal" data-url="{{route('confirm_check_user',['attendance'=>$attendance , 'user'=>$member])}}" >
                                                            <i class=" text-danger fa fa-check"></i>
                                                        </button>

                                                        {{-- Change Attendance Status --}}
                                                        <button  id="{{$member->id}}" data-target="#myModal" data-toggle="modal" data-url="{{route('edit_absentee_status',['attendance'=>$attendance , 'user'=>$member])}}" >
                                                            <i class=" text fa fa-pencil"></i>
                                                        </button>

                                                    </td>
                                                    {{-- <td>
                                                        <span class="badge badge-success">Active</span>
                                                    </td> --}}
                                                    @endallowedTo
                                                </tr>
                                                @endforeach

                                            </tbody>
                                            {{-- Table Body Ends --}}
                                        </table>
                                       
                                </div>
                        
                         
                        {{-- </div> --}}
                        {{--Scrollable Table Ends--}}

                        {{-- {{$absentees->links()}} --}}
                       
                    </div>
                </div>
                {{-- Whole Table Screen Ends --}}
                {{-- Visitors Table Ends --}}

            </div> <!-- end of dashboard container -->

        {{-- </div> --}}
        <!-- /.conainer-fluid -->

</x-layout>