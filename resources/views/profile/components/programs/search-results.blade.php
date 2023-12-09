@if(empty($programs))
    <option value="unknown">Can't Find My Program</option>
@else

    @foreach($programs as $program)
        <option value="{{$program->name}}"> </option>
    @endforeach
        <option value="unknown">Can't Find My Program</option>
@endif