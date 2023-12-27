<form action="{{route('delete_invite',['group'=>$group, 'user'=>$user])}}" method="post">
    @method('delete')
    @csrf
        <div class="modal-title" id="myModalLabel">
            <h6 style="text-align:center">Delete Invite To {{$user->fullname()}}</h6>
        </div>

        <div class="modal-body form-group">
            
         <strong>Are You Sure ? </strong>
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
