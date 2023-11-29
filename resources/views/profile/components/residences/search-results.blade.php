@if(empty($residences))
    <option>Search residence...</option>
@else

    @foreach($residences as $residence)
    <option value="{{$residence->name}}">{{$residence->name." - Zone: ".$residence->zone->name }}</option>
    @endforeach

@endif