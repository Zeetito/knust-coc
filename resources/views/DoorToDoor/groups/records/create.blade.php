<form action="{{route('store_record',['group'=>$group])}}" method="post">
    @csrf
        <div class="modal-title" id="myModalLabel">
            <h5 style="text-align:center">Create New Record</h5>
        </div>

        <div class="modal-body form-group">
            
            <strong for="name">Name</strong>
            <input class="form-control" type="text" name="name" autocomplete="off" id="name" placeholder="Name Of Person">
            @error('name')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror

            @if($dtd->is_zone == 0)
            <input type="text" name="residence_id" value="{{$group->groupable->location_id}}" hidden>
            @else
            <strong for="">Residence</strong>
            <input list="search_result_for_residence_list" autocomplete="off"  value="{{old('residence_id')}}" id="for_residence_list"  class="form-control" name="residence_id" placeholder="Residence search..." >
                <datalist id="search_result_for_residence_list">
                    @foreach($dtd->zone->residences as $residence)
                        <option value="{{$residence->id}}">{{$residence->name." - ".$residence->zone->name}}</option>
                    @endforeach
                </datalist>
                @error('residence_id')
                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                @enderror
            @endif
 
            <strong for="room">Room Number</strong>
            <input class="form-control" type="text"  name="room" autocomplete="off" id="room" >
            @error('room')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror

            <strong>Floor ?</strong>
            <select class="form-control" name="floor" id="">
                <option value="0">Ground</option>
                <option value="1">First</option>
                <option value="2">Second</option>
                <option value="3">Third</option>
                <option value="4">Fourth</option>
                <option value="5">Fifth</option>
                <option value="6">Sixth</option>
                <option value="7">Seventh</option>
                <option value="8">Eighth</option>
                <option value="9">Nineth</option>
                <option value="10">Tenth</option>
            </select>
            @error('floor')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror


            <strong for="info">Extra Info</strong>
            <textarea class="form-control" type="text" Value="None"  name="info" autocomplete="off" id="info" >
            </textarea>
            @error('info')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror

            <strong>Success ?</strong>
            <select class="form-control" name="success" id="" required>
                <option value="">Select</option>
                <option value="3">Complete</option>
                <option value="2">May Have to come back</option>
                <option value="1">Met No One</option>
            </select>
            @error('success')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror


            



        </div>
        
        <div class="modal-footer mt-3">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
