<form action="{{route('store_dtd')}}" method="post">
    @csrf
        <div class="modal-title" id="myModalLabel">
            <h5 style="text-align:center">Create Evangelism Session</h5>
        </div>

        <div class="modal-body form-group">
            
            <strong for="name">Name</strong>
            <input class="form-control" type="text" name="name" autocomplete="off" id="name" required placeholder="Name...">
            @error('name')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror
            
            <strong for="info">Description</strong>
            <input class="form-control" type="text"  name="info" autocomplete="off" id="info" >
            @error('info')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror

            <strong for="is_zone">Target (Zone or Residence)</strong>
            <select name="is_zone" id="is_zone" class="form-control">
                <option value="">Select</option>
                <option value="1">A Zone</option>
                <option value="0">A Residence</option>
            </select>
            @error('is_zone')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror

            <strong for="">Residence If Target is A Residence</strong>
            <input list="search_result_for_residence_list" autocomplete="off"  value="{{old('residence_id')}}" id="for_residence_list"  class="form-control" name="residence_id" placeholder="Residence search..." >
                <datalist id="search_result_for_residence_list">
                    @foreach(App\Models\Residence::all() as $residence)
                        <option value="{{$residence->id}}">{{$residence->name." - ".$residence->zone->name}}</option>
                    @endforeach
                </datalist>
                @error('residence_id')
                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                @enderror

            <strong for="zone_id">Zone If Target is A Zone</strong>
            <select class="form-control" name="zone_id" id="zones">
                <option value="">SELECT ZONE</option>
            @foreach(App\Models\Zone::all() as $zone)
                <option value="{{$zone->id}}"> {{$zone->name}} </option>
            @endforeach
            @error('zone_id')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror

            <input type="text" name="type" value="evangelism" hidden>
            @error('type')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror

        </div>
        
        <div class="modal-footer mt-3">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
