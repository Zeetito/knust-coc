<form action="{{route('store_meeting')}}" method="post">
    @csrf
        <div class="modal-title" id="myModalLabel">
            <h5 style="text-align:center">Add New Meeting Type</h5>
        </div>

        <div class="modal-body form-group">
            
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" autocomplete="off" id="name" required>

            <label for="description">Description</label>
            <input class="form-control" type="text"  name="description" autocomplete="off" id="description" >

        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
