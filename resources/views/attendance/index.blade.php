<x-layout>
      
        
        <div class="container-fluid">
                <div class="dashboard-container">
    
                    {{-- Each Whole Table Screen --}}
                    <div class="process-bar">
                        <div class="process-bar">
                            <div class="process-order">
                                <h3 style="text-align:center">Attendance Sessions</h3>
                                <span>
                                    <form >
                                        <input list="meetings" type="text" id="for_attendance_list" class="search_box" data-url="{{route('search_attendance',['semester'=>App\Models\Semester::active_semester()])}}" placeholder="search name..." style="text-align:center;">
                                            <i class="fa fa-search"></i>
                                            <datalist id="meetings">
                                                @foreach(App\Models\Meeting::all() as $meeting)
                                                    <option value ="{{$meeting->name}}">
                                                @endforeach
                                            </datalist>                                            
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
                                                        <th>Program</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                {{-- Table Body --}}
                                                <tbody id="search_result_for_attendance_list">
                                                   @foreach($attendances as $attendance)
                                                       @if( $attendance->is_active == 0 && auth()->user()->hasPermissionTo(['update_attendance']) ) 
                                                            <tr id="tr_{{$attendance->id}}">
                                                                <td>
                                                                {{$attendance->semesterProgram->name}}
                                                                </td>
                                                                
                                                                
                                                                <td> {{$attendance->is_active === 0 ? "Ended":"In Session"}}</td>
                                                                <td>

                                                                    
                                                                    @allowedTo(['view_attendance'])
                                                                    {{-- Qr Scan page --}}
                                                                    @if($attendance->is_active == 1)
                                                                    <a href="{{route('attendance_qr_page',$attendance->id)}}">
                                                                        <i class="fa fa-qrcode"></i>
                                                                    </a>                            
                                                                    @endif
                                                                    {{-- View Attendance Session --}}
                                                                    <a href="{{route('show_attendance_users',$attendance->id)}}">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>
                                                                    @endallowedTo
                                                                    {{-- Access Attendance Session --}}
                                                                    <a href="{{route('access_attendance_session',$attendance->id)}}">
                                                                        <i class="fa fa-key"></i>
                                                                    </a>
                                                                    @allowedTo(['delete_attendance'])
                                                                    {{--Confirm Delete Attendance Session --}}
                                                                    <span type="button" data-toggle="modal" data-target="#myModal" data-url="{{route("confirm_attendance_delete",["attendance"=>$attendance])}}" >
                                                                            <i class="text-danger fa fa-trash"></i>
                                                                        </span> 
                                                                    @endallowedTo

                                                                    @allowedTo(['reset_attendance'])
                                                                    {{--Confirm Reset Attendance Session --}}
                                                                    <span type="button" data-toggle="modal" data-target="#myModal" data-url="{{route("confirm_attendance_reset",["attendance"=>$attendance])}}" >
                                                                        <i class="text-warning fa fa-repeat"></i>
                                                                    </span> 
                                                                    @endallowedTo

                                                                    @allowedTo(['update_attendance'])
                                                                        <label class="switch switch-text switch-info-outline-alt">
                                                                            @if($attendance->is_active == 1)
                                                                                <button  class="switch-input" name="switch" id="{{$attendance->id}}" data-toggle="modal" data-target="#myModal" data-url ="{{route('confirm_attendance_switch',$attendance)}}" checked>
                                                                                    <i class="text-success fa fa-toggle-on">
                                                                                </button>
                                                                                
                                                                            @else
                                                                                <button   class="switch-input" name="switch" id="{{$attendance->id}}" data-toggle="modal" data-target="#myModal" data-url ="{{route('confirm_attendance_switch',$attendance)}}" >
                                                                                    <i class=" fa fa-toggle-off">
                                                                                </button>
                                                                                
                                                                            @endcan
                                                                        
                                                                    @endallowedTo

                                                                    
                                                                </td>
                                                                {{-- <td>
                                                                    <span class="badge badge-success">Active</span>
                                                                </td> --}}
                                                            </tr>
                                                        @elseif($attendance->is_active == 1)
                                                        <tr id="tr_{{$attendance->id}}">
                                                                <td>
                                                                {{$attendance->semesterProgram->name}}
                                                                </td>
                                                                
                                                                
                                                                <td> {{$attendance->is_active === 0 ? "Ended":"In Session"}}</td>
                                                                <td>
                                                                                                                                           @allowedTo(['view_attendance'])
                                                                    {{-- View Attendance Session --}}
                                                                    <a href="{{route('show_attendance_users',$attendance->id)}}">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>
                                                                    @endallowedTo
                                                                    {{-- Access Attendance Session --}}
                                                                    <a href="{{route('access_attendance_session',$attendance->id)}}">
                                                                        <i class="fa fa-key"></i>
                                                                    </a>
                                                                    @allowedTo(['delete_attendance'])
                                                                    {{--Confirm Delete Attendance Session --}}
                                                                    <span type="button" data-toggle="modal" data-target="#myModal" data-url="{{route("confirm_attendance_delete",["attendance"=>$attendance])}}" >
                                                                            <i class="text-danger fa fa-trash"></i>
                                                                        </span> 
                                                                    @endallowedTo

                                                                    @allowedTo(['reset_attendance'])
                                                                    {{--Confirm Reset Attendance Session --}}
                                                                    <span type="button" data-toggle="modal" data-target="#myModal" data-url="{{route("confirm_attendance_reset",["attendance"=>$attendance])}}" >
                                                                        <i class="text-warning fa fa-repeat"></i>
                                                                    </span> 
                                                                    @endallowedTo

                                                                    @allowedTo(['update_attendance'])
                                                                        <label class="switch switch-text switch-info-outline-alt">
                                                                            @if($attendance->is_active == 1)
                                                                                <button  class="switch-input" name="switch" id="{{$attendance->id}}" data-toggle="modal" data-target="#myModal" data-url ="{{route('confirm_attendance_switch',$attendance)}}" checked>
                                                                                    <i class="text-success fa fa-toggle-on">
                                                                                </button>
                                                                                
                                                                            @else
                                                                                <button   class="switch-input" name="switch" id="{{$attendance->id}}" data-toggle="modal" data-target="#myModal" data-url ="{{route('confirm_attendance_switch',$attendance)}}" >
                                                                                    <i class=" fa fa-toggle-off">
                                                                                </button>
                                                                                
                                                                            @endcan
                                                                        
                                                                    @endallowedTo
                                                                </td>
                                                                {{-- <td>
                                                                    <span class="badge badge-success">Active</span>
                                                                </td> --}}
                                                            </tr>
                                                        @endif

                                                  @endforeach

                                                </tbody>
                                                {{-- Table Body Ends --}}
                                            </table>
 
                                           
                                            
                                           
                                    </div>
                            
                             
                            </div>
                            {{--Users Table Ends--}}
    
                            {{-- {{$attendances->links()}} --}}
                           
                        </div>
                    </div>
                    {{-- Whole Table Screen Ends --}}
    
                    {{-- Create new Attendance Session Div --}}
                    @allowedTo(['create_attendance'])
                        @include('attendance.create')
                    @endallowedTo
    
                </div> <!-- end of dashboard container -->
    
            </div>
            <!-- /.conainer-fluid -->
    
</x-layout>