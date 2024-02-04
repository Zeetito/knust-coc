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