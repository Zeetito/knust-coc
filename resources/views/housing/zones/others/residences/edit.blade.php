<form action="{{route('update_user_residence',['user_residence'=>$residence->id])}}" method="post">
    @csrf
    @method('put')
        <div class="modal-title" id="myModalLabel">
                    {{-- <h5 style="text-align:center">e</h5> --}}
        </div>

        <div class="modal-body">
               
            <strong>Editing Your Custom Residence</strong> <br><br>

            <strong>Name</strong>
            <input type="text" name="name" class="form-control" value="{{$residence->name}}" required><br>

            @allowedTo(['update_residence'])
            <strong>Zone</strong>
            <select name="zone_id" id="zone_id" class="form-control" >
                @if($residence->zone)
                <option value="{{$residence->zone->id}}">{{$residence->zone->name}}</option>
                @else
                <option value="none">Not Sure</option>
                @endif
                
                @foreach(App\Models\Zone::all() as $zone)
                <option value="{{$zone->id}}">{{$zone->name}}</option>
                @endforeach
                <option value="none">OTHERS</option>
            </select>
            @error('zone_id')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror
            @endallowedTo
            
            <strong>Description</strong>
            <input type="text" name="description" class="form-control" value="{{$residence->description}}" required><br>
            @error('description')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror
            
            {{-- <input type="text" name="category" class="form-control" value="{{$residence->name}}"><br> --}}
        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>