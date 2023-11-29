<form action="{{route('dtd_subgroup_store',['dtd'=>$dtd])}}" method="post">
    @csrf
        <div class="modal-title" id="myModalLabel">
            <h6 style="text-align:center">Create A Sub Group for {{$dtd->name}}</h6>
        </div>

        <div class="modal-body form-group">
            
            <strong for="name">Name</strong>
            <input class="form-control" type="text" name="name" autocomplete="off" id="name" required placeholder="Eg. Group A">
            @error('name')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror
            
            <strong for="info">Description</strong>
            <input class="form-control" type="text"  name="info" autocomplete="off" id="info" >
            @error('info')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror

        </div>
        
        <div class="modal-footer mt-3">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
