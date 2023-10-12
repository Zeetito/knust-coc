@foreach($users as $user)
<tr id="tr_{{$user->username}}">

    {{-- Name And Avatar--}}

    <td>
        <a >
            <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
        </a>
        {{$user->fullname()}}
    </td>

    {{-- Department --}}
    <td>
        {{$user->department()->name == "" ? "No Department": $user->department()->name}}
    </td>

    {{-- Program --}}
    <td>
        {{$user->program->name}}
    </td>

    {{-- Action 
    @can('update',$faculty)
    <td>
        <a class="btn check_button btn-danger" id="{{$user->id}}" data-url="#">
            <i class="fa fa-remove"></i>
        </a>     
    </td>
    @endcan --}}

</tr>
@endforeach