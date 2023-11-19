<x-layout>
      
        
        <div class="container-fluid">
                <div class="dashboard-container">
    
                    {{-- Each Whole Table Screen --}}
                    <div class="">
                        <div class="">
                            <div class="process-order">
                                <a href="{{route('access_attendance_session',['attendance'=>$attendance])}}">
                                    <h3 style="text-align:center"> Attendance Session: {{$attendance->semesterProgram->name." - ".$attendance->semesterProgram->created_at->format('Y-M-d-D')}}</h3>
                                    <i class="fa fa-key"></i>
                                </a>

                              {{-- Search Box --}}
                                <span>
                                    <form >
                                        <input  type="text" id="for_user_list" class="search_box" data-url="{{route("search_attendance_checked_users",['attendance'=>$attendance] )}}" placeholder="search name..." style="text-align:center;">
                                            <i class="fa fa-search"></i>
                                    </form>
                            </span>

                            {{-- Start or End Session --}}
                            @allowedTo(['update_attendance'])
                                @if($attendance->is_active == 1)
                                    <button  class="float-right btn btn-danger"  id="{{$attendance->id}}" data-toggle="modal" data-target="#myModal" data-url ="{{route('confirm_attendance_switch',$attendance)}}">
                                        End Session
                                    </button>
                                    
                                @else
                                    <button   class="float-right btn btn-succes"  id="{{$attendance->id}}" data-toggle="modal" data-target="#myModal" data-url ="{{route('confirm_attendance_switch',$attendance)}}" >
                                        Start Session
                                    </button>
                                    
                                @endcan
                            
                        @endallowedTo

                            </div>
    
                            {{-- Attendance Table --}}
                            <div class="pre-scrollable" >
    
                                    <div class="card-body">
                                        {{-- <h5>Users</h5> --}}
                                            {{--  --}}
                                           
                                    </div>
                            
                             
                            </div>
                            {{--Scrollable Table Ends--}}
    
                            {{-- {{$members->links()}} --}}
                           
                        </div>
                    </div>
                    {{-- Whole Table Screen Ends --}}
    
                    {{-- Card Div Begins here --}}

                    <div class="card">
                        <div class="card-header">
                            Summary : {{$attendance->semesterProgram->name ." - ".$attendance->semesterProgram->created_at->format('M-d-D')  }}
                            <div class="card-actions">
                                <a href="#">
                                    <small class="text-muted">docs</small>
                                </a>
                            </div>
                        </div>

                        <div class="card-body row">
                            {{-- Attendnace Summary --}}
                            
                                <div class="h5 col-12">Members Present <a class="btn btn-info float-right">See Details</a> </div>
                            {{--h5 Members Card --}}
                                <div class="card col-sm-4">

                                        <div class="card-header">
                                           Members
                                            <span class="badge badge-pill badge-info float-right">{{$attendance->members()->count()}}</span>
                                        </div>

                                        <div class="card-body">
                                                <p>
                                                        Gents: {{$attendance->males_members_present()->count()}}
                                                    </p>   
                                                    <p>
                                                        Ladies: {{$attendance->females_members_present()->count()}}
                                                    </p>   
                                                    <p>
                                                        Total: {{$attendance->members()->count()}}
                                                    </p>   
                                        </div>
                                </div>
                            {{-- Visitors Card --}}
                                <div class="card col-sm-4">

                                        <div class="card-header">
                                           <a href="{{route('show_guests',['attendance'=>$attendance])}}">Visitors <i class="fa fa-eye"></i></a>
                                            <span class="badge badge-pill badge-info float-right">{{$attendance->visitors_count()}}</span>
                                        </div>

                                        <div class="card-body">
                                                <p>
                                                        Gents: {{$attendance->users_male_visitors_present()->count() + $attendance->males_guests_present()->count() }}
                                                    </p>   
                                                    <p>
                                                        Ladies: {{$attendance->users_female_visitors_present()->count() + $attendance->females_guests_present()->count() }}
                                                    </p>   
                                                    <p>
                                                        Total: {{$attendance->visitors_count()}}
                                                    </p>   
                                        </div>
                                </div>
                            {{-- Totlas Card --}}
                                <div class="card col-sm-4">

                                        <div class="card-header">
                                           Totals
                                            <span class="badge badge-pill badge-info float-right">{{$attendance->total_count()}}</span>
                                        </div>

                                        <div class="card-body">
                                                <p>
                                                        Gents: {{$attendance->males_members_present()->count() + $attendance->males_guests_present()->count() +  $attendance->users_male_visitors_present()->count() }}
                                                    </p>   
                                                    <p>
                                                        Ladies: {{$attendance->females_members_present()->count() + $attendance->females_guests_present()->count() +  $attendance->users_female_visitors_present()->count()  }}
                                                    </p>   
                                                    <p>
                                                        Total: {{$attendance->total_count()}}
                                                    </p>   
                                        </div>
                                </div>

                                
                            {{-- Members Absent --}}
                            @if($attendance->hasAbsentees())
                                <div class="h5 col-12">Members Absent  <a class="btn btn-info float-right" href="{{route('show_absentees',['attendance'=>$attendance])}}" >See Details</a></div>

                                {{-- Available Absentees --}}
                                <div class="card col-sm-4">

                                    <div class="card-header">
                                       Absentees (No known Reason)
                                        <span class="badge badge-pill badge-info float-right">{{$attendance->available_absentees()->count()}}</span>
                                    </div>

                                    <div class="card-body">
                                            <p>
                                                    Gents: {{$attendance->available_gent_absentees()->count()}}
                                                </p>   
                                                <p>
                                                    Ladies: {{$attendance->available_female_absentees()->count()}}
                                                </p>   
                                                <p>
                                                    Total: {{$attendance->available_absentees()->count()}}
                                            </p>   
                                    </div>

                                </div>
                                {{-- Unavailable Absentees --}}
                                <div class="card col-sm-4">

                                    <div class="card-header">
                                       Absentees (Unavailable With Reason)
                                        <span class="badge badge-pill badge-info float-right">{{$attendance->unavailable_absentees()->count()}}</span>
                                    </div>

                                    <div class="card-body">
                                            <p>
                                                    Gents: {{$attendance->unavailable_gent_absentees()->count()}}
                                                </p>   
                                                <p>
                                                    Ladies: {{$attendance->unavailable_female_absentees()->count()}}
                                                </p>   
                                                <p>
                                                    Total: {{$attendance->unavailable_absentees()->count()}}
                                            </p>   
                                    </div>

                                </div>

                                {{-- Total Absentees --}}
                                <div class="card col-sm-4">

                                    <div class="card-header">
                                       Totals
                                        <span class="badge badge-pill badge-info float-right">{{$attendance->all_absentees()->count()}}</span>
                                    </div>

                                    <div class="card-body">
                                            <p>
                                                    Gents: {{$attendance->all_gent_absentees()->count()}}
                                                </p>   
                                                <p>
                                                    Ladies: {{$attendance->all_female_absentees()->count()}}
                                                </p>   
                                                <p>
                                                    Total: {{$attendance->all_absentees()->count()}}
                                            </p>   
                                    </div>

                                </div>
                            @endif

                        </div>
                        
                    </div>

                    {{-- Card Ends --}}


                    {{-- Visitors Table --}}
                    <div class="pre-scrollable" >

                            <div class="card-body">
                                  
                                    
                            </div>
                    
                    </div>
                    {{-- Visitors Table Ends --}}
    
                </div> <!-- end of dashboard container -->
    
            </div>
            <!-- /.conainer-fluid -->
    
</x-layout>