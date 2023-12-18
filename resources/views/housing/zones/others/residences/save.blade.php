<form action="{{route('save_user_residence',['id'=>$residence->id,'user'=>$user])}}" method="post">
    @csrf
        <div class="modal-title" id="myModalLabel">
                    {{-- <h5 style="text-align:center">e</h5> --}}
        </div>

        <div class="modal-body">
               
            <strong>Saving This Custom Residence</strong> <br><br>

            
            <strong>Name</strong>
            <input type="text" name="name" value="{{$residence->name}}" class="form-control" required><br>

            <strong>Zone</strong>
            <select name="zone_id" id="" class="form-control" required>
                <option value="">select</option>
                @foreach(App\Models\Zone::all() as $zone)
                <option value="{{$zone->id}}">{{$zone->name}}</option>
                @endforeach
            </select><br>

            <strong>Description/LandMarks</strong>
            <textarea name="description" id="" class="form-control" cols="30" rows="10">

            </textarea>
            
            {{-- <input type="text" name="category" class="form-control" value="{{$residence->name}}"><br> --}}
        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>