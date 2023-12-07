@if(empty($residences))
    <option value="unknown">I come from Home</option>
    <option value="unknown">Can't Find My Hostel/Homestel</option>
@else

    @foreach($residences as $residence)
    <option value="{{$residence->name}}">{{$residence->name." - Zone: ".$residence->zone->name }}</option>
    @endforeach
    <option value="unknown">I come from Home</option>
    <option value="unknown">Can't Find My Hostel/Homestel</option>

@endif