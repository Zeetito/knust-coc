<form action="{{route('handle_invite',['user'=>$user ,'group'=>$group])}}" method="post">
    @method('PUT')
    @csrf
        <div class="modal-title" id="myModalLabel">
            <h6 style="text-align:center">Invitation to Join - {{$group->name}}</h6>
        </div>

        <div class="modal-body form-group">


            <strong>Accept Invitation from {{$host->fullname()}} ?</strong>
           <select name="response" id="" required>
                <option value="">Select</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
           </select>

        </div>
        
        <div class="modal-footer mt-3">
            <input type="submit" name="submit_user" value="Respond" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Exit</button>
        </div>                                  
</form>
