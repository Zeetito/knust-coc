<form action="{{route('update_user_residence',['id'=>$residence->id])}}" method="post">
    @csrf
    @method('put')
        <div class="modal-title" id="myModalLabel">
                    {{-- <h5 style="text-align:center">e</h5> --}}
        </div>

        <div class="modal-body">
               
            <strong>Editing Your Custom Residence</strong> <br><br>

            <strong>Name</strong>
            <input type="text" name="name" class="form-control" value="{{$residence->name}}" required><br>
            
            <strong>Description</strong>
            <input type="text" name="description" class="form-control" value="{{$residence->description}}" required><br>
            
            {{-- <input type="text" name="category" class="form-control" value="{{$residence->name}}"><br> --}}
        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>