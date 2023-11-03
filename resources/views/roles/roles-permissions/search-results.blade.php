@foreach($non_permissions as $permission)

<tr id="tr_{{$permission->id}}">
    <td>
        {{$permission->name}}
    </td>

    {{-- Actions --}}
    <td>
        {{-- @can('update',$user) --}}
         <button class="check_button" id="{{$permission->id}}" data-url="{{route('assign_role_permission',['role'=>$role,'permission'=>$permission])}}" >
              <i class="fa fa-check"></i>
        </button>
        {{-- @endcan --}}
    </td>
    {{-- <td>
        <span class="badge badge-success">Active</span>
    </td> --}}
</tr>
@endforeach