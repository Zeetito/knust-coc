<td>
        <a >
            <img src="{{$member->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
        </a>
    {{$member->fullname()}}
</td>
<td>{{$member->biodata() !=null ? $member->zone()->name : "No Zone" }}</td>
<td>
    @if($member->is_checked($attendance))
                @can('check',$member)
                    {{-- Uncheck User button --}}
                    <span type="button" data-toggle="modal" data-target="#myModal" id="{{$member->id}}"  data-url="{{route('confirm_uncheck_user',['attendance'=>$attendance , 'user'=>$member])}}" >
                        <i class="text-success fa fa-check"></i>
                    </span> 
                    @else
                    {{-- Not A button --}}
                    <span type="button" class="button message"  >
                        <i class="text-success fa fa-check"></i>
                    </span>
                @endcan

    @else
                {{-- Check User Button --}}
                @can('check',$member)
                <button class="check_button" id="{{$member->id}}" data-url="{{route('check_user',['attendance'=>$attendance , 'user'=>$member])}}" >
                        <i class=" text-danger fa fa-check"></i>
                </button>

                @else

                <button class="" id="{{$member->id}}" data-url="" >
                        <i class=" text-info fa fa-check"></i>
                    </button>
                @endcan

    @endif

    
</td>
{{-- <td>
    <span class="badge badge-success">Active</span>
</td> --}}