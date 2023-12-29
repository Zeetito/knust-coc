<form action="{{route('delete_ministry_account_session',['account'=>$account])}}" method="post">
    @csrf
    @method('delete')
        <div class="card-body modal-title" id="myModalLabel">
                    <h5 style="text-align:center">Deleting Session</h5>

                    <div class="h6">
                        {{$account->name}}
                    </div>
        </div>

        <div class="modal-body">


            <strong>Confirm</strong>
            <select name="response" class="form-control" required>
                <option value="">Select</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            
          
            

        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Delete" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>                                  
</form>
