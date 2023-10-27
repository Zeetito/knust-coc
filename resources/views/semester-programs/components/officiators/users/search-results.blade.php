@if(empty($users))
    <option>Search User</option>
@else

    @foreach($users as $user)
        <option value="{{$user->id}}">{{$user->fullname()}}</option>
    @endforeach

@endif