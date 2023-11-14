@foreach($users as $user)
<tr>
    {{-- Avatar and Fullname --}}
    <td>
            <a >
            <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
        </a>
        {{$user->fullname()}}
        
    </td>
    <td>{{$user->username}}</td>
    {{-- <td>{{ $user->program() !="" ? $user->program()->name : "Program Name" }}</td> --}}
    <td>
        @can('update',$user)
        <a href="{{route('view_profile',$user->id)}}">
                <i class="fa fa-eye"></i>
        </a>
        @endcan
        {{-- See Short info --}}
            <span class="btn-info modal_button"  data-url="{{route('show_modal_info',$user->id)}}">
                <i class="fa fa-address-card-o"></i>
        </span>
        {{-- View Photos --}}
        
        <a href="{{route('upload_user_image',$user)}}">
            <i class="fa fa-image"></i>
        </a>
    </td>
    {{-- <td>
        <span class="badge badge-success">Active</span>
    </td> --}}
</tr>
@endforeach