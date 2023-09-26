@foreach($members as $member)
{{-- {{$user_who_marked = $attendance->user_marked_by($member->pivot->checked_by)}} --}}
<tr id="tr_{{$member->id}}">
    <td>{{$member->firstname." ".$member->lastname}}</td>
    <td>{{$member->zone !="" ? $member->zone->name : "No Zone" }}</td>
    
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