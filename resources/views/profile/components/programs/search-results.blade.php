@if(empty($programs))
    <option>Search Program</option>
@else

    @foreach($programs as $program)
        <option value="{{$program->name}}"> </option>
    @endforeach

@endif