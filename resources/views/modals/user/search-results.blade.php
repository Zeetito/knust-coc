
  @if(!empty($users))

        @foreach($users as $user)
        <tr>
            <td>
                {{$user->firstname." ".$user->lastname}}
                
                        <a >
                            <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                        </a>
                                                                
            </td>
            <td>{{$user->username}}</td>
            <td>{{ $user->program !="" ? $user->program->name : "Program Name" }}</td>
            <td>
                @can('update',$user)
                <a href="{{route('view_profile',$user->id)}}">
                        <i class="fa fa-eye"></i>
                </a>
                @endcan
                <span class="modal_button "  data-url="{{route('show_modal_info',$user->id)}}">
                        <i class="fa fa-address-card-o"></i>
                </span>
            </td>
            {{-- <td>
                <span class="badge badge-success">Active</span>
            </td> --}}
        </tr>
        @endforeach

    @else

    <tr>No results</tr>
    
    @endif