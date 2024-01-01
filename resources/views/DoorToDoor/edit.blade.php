<form action="{{route('update_dtd',['dtd'=>$dtd])}}" method="post">
    @csrf
    @method('put')
        <div class="modal-title" id="myModalLabel">
            <h5 style="text-align:center">Create Evangelism Session</h5>
        </div>

        <div class="modal-body form-group">
            
            <strong for="name">Name</strong>
            <input class="form-control" type="text" name="name" value="{{$dtd->name}}" autocomplete="off" id="name" required placeholder="Name...">
            @error('name')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror
            
            <strong for="info">Description</strong>
            <input class="form-control" type="text"  name="info" value="{{$dtd->info}}" autocomplete="off" id="info" >
            @error('info')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror

        </div>
        
        <div class="modal-footer mt-3">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
