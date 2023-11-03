@foreach($members as $member)
    {{-- {{$user_who_marked = $attendance->user_marked_by($member->pivot->checked_by)}} --}}
    <tr id="tr_{{$member->id}}">
        <td>
                <a >
                    <img src="{{$member->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                </a>
            {{$member->fullname()}}
        </td>
        <td>{{$member->biodata() !=null ? $member->zone()->name : "No Zone" }}</td>
        
        <td> {{ $member->checked_by($attendance)->fullname() }} </td>


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
    </tr>
@endforeach