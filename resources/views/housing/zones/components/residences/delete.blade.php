<form action="{{route('delete_residence',['residence'=>$residence])}}" method="post">
    @csrf
    @method('delete')
        <div class="modal-title" id="myModalLabel">
            <strong style="text-align:center">You're Deleting - {{$residence->name}}</strong>
        </div>

        <div class="modal-body form-group">

            <select name="response" id="" required>
                <option value="">Select</option>
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>

        </div>
        
        <div class="modal-footer mt-3">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
        </div>                                  
</form>
