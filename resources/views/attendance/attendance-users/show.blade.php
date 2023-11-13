<x-layout>
      
        
        <div class="container-fluid">
                <div class="dashboard-container">
    
                    {{-- Each Whole Table Screen --}}
                    <div class="process-bar">
                        <div class="process-bar">
                            <div class="process-order">
                                <a href="{{route('access_attendance_session',['attendance'=>$attendance])}}">
                                    <h3 style="text-align:center"> Attendance Session: {{$attendance->semester_program->name." - ".$attendance->semester_program->created_at->format('Y-M-d-D')}}</h3>
                                    <i class="fa fa-key"></i>
                                </a>

                              {{-- Search Box --}}
                                <span>
                                    <form >
                                        <input  type="text" id="for_user_list" class="search_box" data-url="{{route("search_attendance_checked_users",['attendance'=>$attendance] )}}" placeholder="search name..." style="text-align:center;">
                                            <i class="fa fa-search"></i>
                                    </form>
                            </span>
                            </div>
    
                            {{-- Attendance Table --}}
                            <div class="pre-scrollable" >
    
                                    <div class="card-body">
                                        <h5>Users</h5>
                                            <table class="table table-striped">
                                                
                                                {{-- Table Head --}}
                                                <thead>
                                                    <tr>
                                                        <th>Member</th>
                                                        <th>Zone</th>
                                                        <th>Marked By</th>
                                                        @allowedTo(['update_attendance'])
                                                        <th>Action</th>
                                                        @endallowedTo
                                                    </tr>
                                                </thead>
                                                {{-- Table Body --}}
                                                <tbody id="search_result_for_user_list">
                                        

                                                    @foreach($members as $member)
                                                    {{-- {{$user_who_marked = $attendance->user_marked_by($member->pivot->checked_by)}} --}}
                                                    <tr  id="tr_{{$member->id}}">
                                                        
                                                        <td>
                                                            <a >
                                                                <img src="{{$member->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                                            </a>
                                                            {{$member->fullname()}}
                                                        </td>
                                                        
                                                        <td>{{$member->biodata() !=null ? $member->zone()->name : "No Zone" }}</td>
                                                        
                                                        <td> {{ $member->checked_by($attendance)->fullname()}} </td>

                                                        @allowedTo(['update_attendance'])
                                                        <td>
                                                            @if($member->is_checked($attendance))

                                                                        @can('check',$member)
                                                                            {{-- Uncheck User button --}}
                                                                            <span type="button" data-toggle="modal" data-target="#myModal" id="{{$member->id}}"  data-url="{{route('confirm_uncheck_user',['attendance'=>$attendance , 'user'=>$member])}}" >
                                                                                <i class="text-warning fa fa-check"></i>
                                                                            </span> 
                                                                        @else
                                                                            {{-- Not A button --}}
                                                                            <span type="button" class="button message"  >
                                                                                <i class="text-success fa fa-check"></i>
                                                                            </span>
                                                                        @endcan

                                                            @else
                                                                        {{-- Check User Button --}}
                                                                        <button class="check_button" id="{{$member->id}}" data-url="{{route('check_user',['attendance'=>$attendance , 'user'=>$member])}}" >
                                                                            <i class=" text-danger fa fa-check"></i>
                                                                        </button>

                                                            @endif

                                                            
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
                            
                             
                            </div>
                            {{--Scrollable Table Ends--}}
    
                            {{$members->links()}}
                           
                        </div>
                    </div>
                    {{-- Whole Table Screen Ends --}}
    
                    {{-- Card Div Begins here --}}

                    <div class="card">
                        <div class="card-header">
                            Summary : {{$attendance->semester_program->name ." - ".$attendance->semester_program->created_at->format('M-d-D')  }}
                            <div class="card-actions">
                                <a href="#">
                                    <small class="text-muted">docs</small>
                                </a>
                            </div>
                        </div>

                        <div class="card-body row">
                            {{-- Members Card --}}
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
                                           <a href={{"#"}}>Visitors <i class="fa fa-eye"></i></a>
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
                                
                                {{-- <div class="chart-wrapper"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; inset: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                                    <canvas id="canvas-pie" width="70" height="50" style="display: block; height: 392px; width: 392px;"></canvas>
                                </div> --}}
                        </div>
                        
                    </div>

                    {{-- Card Ends --}}


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
                                                    <td>{{$member->biodata() == null ? "" : $member->local_congregation()}}</td>
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
    
                </div> <!-- end of dashboard container -->
    
            </div>
            <!-- /.conainer-fluid -->
    
</x-layout>