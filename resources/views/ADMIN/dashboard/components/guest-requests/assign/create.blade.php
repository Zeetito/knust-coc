<form action="{{route('assign_guest_request_to',['guest_request'=>$guest_request])}}" method="post">
    @csrf
        <div class="modal-title" id="myModalLabel">
                    <h5 style="text-align:center">Assigning This Request</h5>
        </div>

        <div class="modal-body">
                <div class="h6">
                   Select or Search User
                </div>

                <input type="text" name="user_id" list="user_list" class="form-control" placeholder="Search user">
                <datalist id="user_list">
                    @foreach(App\Models\User::handle_guest_request() as $user)
                        <option value="{{$user->id}}">{{$user->fullname()." -- (".$user->assigned_guest_requests()->count()." Requests)"}} </option>
                    @endforeach
                </datalist>

        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
