<form action="{{route('store_invite',['group'=>$group])}}" method="post">
    @csrf
        <div class="modal-title" id="myModalLabel">
            <h5 style="text-align:center">Invite User</h5>
        </div>

        <div class="modal-body form-group">


            <strong>Search/Select User</strong>
            <input type="text" list="user_list" name="user_id" required>
            <datalist id="user_list" >
                <option value="">select</option>
                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->fullname()}}</option>
                @endforeach
                    
            </datalist>

        </div>
        
        <div class="modal-footer mt-3">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
