@foreach($non_users as $user)
<tr id="tr_{{$user->id}}">
{{-- Name and avatar of user --}}
<td>
    <a >
        <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
    </a>
    {{$user->firstname." ".$user->lastname}}
    
                                                   
</td>
{{-- Zone of the user --}}
<td>{{$user->username}}</td>

{{-- Residence of the User --}}
<td>{{ $user->Zone !="" ? $user->Zone->name : "Zone Name" }}</td>

{{-- Actions --}}
<td>
    @can('update',$user)
    <button class="check_button" id="{{$user->id}}" data-url="{{route('give_user_role',['role'=>$role, 'user'=>$user])}}" >
          <i class="fa fa-check"></i>
    </button>
    @endcan
</td>
{{-- <td>
    <span class="badge badge-success">Active</span>
</td> --}}
</tr>
@endforeach