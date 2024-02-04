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