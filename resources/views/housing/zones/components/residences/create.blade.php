<form action="{{route('store_residence')}}" method="post">
    @csrf
        <div class="modal-title" id="myModalLabel">
            <h6 style="text-align:center">Creating A New Residence</h6>
        </div>

        <div class="modal-body form-group">

            <div class="mb-3">
                <strong>Name Of Residence</strong>
                <input type="text" class="form-control" name="name" required autocomplete="off">
                @error('name')
                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                @enderror

            </div>

            <div class="mb-3">
                <strong>Zone</strong>
                <select name="zone_id" id="zone_id" class="form-control" required>
                    <option value="{{$zone->id}}">{{$zone->name}}</option>
                </select>
                @error('zone_id')
                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                @enderror

            </div>

            <div class="mb-3">
                <strong>Description/Landmark</strong>
                <textarea type="text" name="description" class="form-control" required>
                </textarea>
                @error('description')
                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                @enderror
            </div>

        </div>
        
        <div class="modal-footer mt-3">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
        </div>                                  
</form>
