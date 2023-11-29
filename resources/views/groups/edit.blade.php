<form action="{{route('update_group',['group'=>$group])}}" method="post">
    @method('PUT')
    @csrf
        <div class="modal-title" id="myModalLabel">
            <h6 style="text-align:center">Edit Group : {{$group->name}}</h6>
        </div>

        <div class="modal-body form-group">
            
            <strong for="name">Name</strong>
            <input class="form-control" type="text" name="name" autocomplete="off" id="name"  value="{{$group->name}}" required placeholder="Eg. Group A">
            @error('name')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror
            
            <strong for="info">Description</strong>
            <input class="form-control" type="text" value="{{$group->info}}" name="info" autocomplete="off" id="info" >
            @error('info')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror

        </div>
        
        <div class="modal-footer mt-3">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
