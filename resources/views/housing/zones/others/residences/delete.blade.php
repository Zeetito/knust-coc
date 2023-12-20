<form action="{{route('delete_user_residence',['user_residence'=>$residence->id])}}" method="post">
    @csrf
    @method('delete')
        <div class="modal-title" id="myModalLabel">
                    {{-- <h5 style="text-align:center">e</h5> --}}
        </div>

        <div class="modal-body">
               
            <strong>Deleting this Custom Residence</strong> <br><br>

            <strong>Name: {{$residence->name}}</strong>
            
            <strong>Confirm</strong>
            <select name="response" id="" class="form-control" required>
                <option value="">select</option>
                <option value="">No</option>
                <option value="1">Yes, Delete</option>
            </select>
            
            {{-- <input type="text" name="category" class="form-control" value="{{$residence->name}}"><br> --}}
        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>