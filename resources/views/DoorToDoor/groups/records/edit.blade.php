<form action="{{route('update_dtd_record',['record_id'=>$record->id])}}" method="post">
    @method('put')
    @csrf
        <div class="modal-title" id="myModalLabel">
            <h5 style="text-align:center">Update This Record</h5>
        </div>

        <div class="modal-body form-group">
            
            <strong for="name">Name</strong>
            <input class="form-control" type="text" value="{{old('name',$record->name)}}" name="name" autocomplete="off" id="name" placeholder="Name Of Person">
            @error('name')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror

            @if($dtd->is_zone == 0)
            <input type="text" name="residence_id" value="{{$record->residence_id}}" hidden>
            @else
            <strong for="">Residence</strong>
            ({{App\Models\Residence::find($record->residence_id)->name}})
            <input list="search_result_for_residence_list" autocomplete="off" value="{{$record->residence_id}}" id="for_residence_list"  class="form-control" name="residence_id"  >
                <datalist id="search_result_for_residence_list">
                    {{-- <option value="{{$record->residence_id}}">{{App\Models\Residence::find($record->residence_id)->name}}</option> --}}
                    @foreach($dtd->zone->residences as $residence)
                        <option value="{{$residence->id}}">{{$residence->name." - ".$residence->zone->name}}</option>
                    @endforeach
                </datalist>
                @error('residence_id')
                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                @enderror
            @endif

 
            <strong for="room">Room Number</strong>
            <input class="form-control" type="text"  value="{{old('room',$record->room)}}" name="room" autocomplete="off" id="room" >
            @error('room')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror

            <strong>Floor ?</strong>
            <select class="form-control" value="{{old('floor',$record->floor)}}" name="floor" id="">
                <option value="{{$record->floor}}">{{$record->floor}}</option>
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
            <textarea class="form-control" type="text" Value="None"   name="info" autocomplete="off" id="info" >
                {{$record->info}}
            </textarea>
            @error('info')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror

            <strong>Success ?</strong>
            <select class="form-control" value="{{old('success',$record->success)}}" name="success" id="" required>
                <option value="{{$record->success}}">Maintain</option>
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
