@foreach($members as $member)
<tr id="tr_{{$member->id}}">
    <td>{{$member->fullname()}}</td>
    <td>{{$member->biodata !=null ? $member->zone->name : "No Zone" }}</td>
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