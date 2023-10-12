<x-layout>
      
        
        <div class="container-fluid">
                <div class="dashboard-container">
    
                    {{-- Each Whole Table Screen --}}
                    <div class="process-bar">
                        <div class="process-bar">
                            <div class="process-order">
                                <h3 style="text-align:center"> Attendance Session: {{$attendance->meeting->name." - ".$attendance->created_at->format('Y-M-d-D')}}</h3>
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
                                            <table class="table table-striped">
                                                {{-- Table Head --}}
                                                <thead>
                                                    <tr>
                                                        <th>Member</th>
                                                        <th>Zone</th>
                                                        <th>Marked By</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                {{-- Table Body --}}
                                                <tbody id="search_result_for_user_list">
                                        

                                                    @foreach($members as $member)
                                                    {{-- {{$user_who_marked = $attendance->user_marked_by($member->pivot->checked_by)}} --}}
                                                    <tr id="tr_{{$member->id}}">
                                                        <td>{{$member->fullname()}}</td>
                                                        
                                                        <td>{{$member->biodata !=null ? $member->zone->name : "No Zone" }}</td>
                                                        
                                                        <td> {{ $member->checked_by($attendance)->firstname." ".$member->checked_by($attendance)->lastname }} </td>


                                                        <td>
                                                            @if($member->is_checked($attendance))

                                                                        @can('check',$member)
                                                                            {{-- Uncheck User button --}}
                                                                            <span type="button" class="check_button"  data-toggle="modal" data-target="#myModal" data-url="{{route('check_user',['attendance'=>$attendance , 'user'=>$member])}}" >
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
                            Summary : {{$attendance->meeting->name ." - ".$attendance->created_at->format('M-d-D')  }}
                            <div class="card-actions">
                                <a href="#">
                                    <small class="text-muted">docs</small>
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <p>
                                Gents: {{$attendance->males_present()->count()}}
                            </p>   
                            <p>
                                Ladies: {{$attendance->females_present()->count()}}
                            </p>   
                            <p>
                                Total: {{$attendance->users()->count()}}
                            </p>   
                            {{-- <div class="chart-wrapper"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; inset: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
                                <canvas id="canvas-pie" width="70" height="50" style="display: block; height: 392px; width: 392px;"></canvas>
                            </div> --}}
                        </div>
                        
                    </div>

                    {{-- Card Ends --}}
    
                </div> <!-- end of dashboard container -->
    
            </div>
            <!-- /.conainer-fluid -->
    
</x-layout>