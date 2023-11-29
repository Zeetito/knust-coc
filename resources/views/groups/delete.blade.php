<form action="{{route('delete_group',['group'=>$group])}}" method="post">
    @method('delete')
    @csrf
        <div class="modal-title" id="myModalLabel">
            <h6 style="text-align:center">Delete Group</h6>
        </div>

        <div class="modal-body form-group">
            
         <strong>Do You really want to Delete {{$group->name}} </strong>
         <select name="response" class="form-control" id="" required>
            <option value="">Select</option>
            <option value="1">Yes</option>
         </select>

        </div>
        
        <div class="modal-footer mt-3">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
