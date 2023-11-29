<form action="{{route('remove_user',['user'=>$user, 'group'=>$group])}}" method="post">
    @method('put')
    @csrf
        <div class="modal-title" id="myModalLabel">
            <h5 style="text-align:center">Confirm</h5>
        </div>

        <div class="modal-body form-group">
          <strong>Remove {{$user->fullname()}} From This Group ?</strong>
            <select name="response" id="" required>
                <option value="">Select</option>
                <option value="1">Yes</option>
            </select>

        </div>
        
        <div class="modal-footer mt-3">
            <input type="submit"  name="submit_user" value="Confirm" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
