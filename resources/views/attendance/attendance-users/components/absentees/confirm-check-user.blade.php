<form action="{{route('check_absentee',['attendance'=>$attendance , 'user'=>$user])}}" method="post">
    @csrf
        <div class="modal-title" id="myModalLabel">
            <span style=" ">
                    <h4 style="text-align:center">Confirm</h4>
        </div>
        <div class="modal-body">
                {{-- User Name --}}
                <p>You are Marking {{$user->fullname()}} present. </p>
                {{-- <input type="text"  value="{{$officiator}}" class="search_box form-control" name="user_id" id="for_user_list"  autocomplete="off" readonly hidden required>
                <input type="text"  value="{{App\Models\User::find($officiator)->fullname()}}" class="search_box form-control" name="" id=""  autocomplete="off" readonly > --}}
            
    
                <input type="checkbox" name="status" value="user" hidden checked>
    
            </span>
            <br>
            {{-- Officiating Role --}}
        </div>
    <div class="modal-footer">
        <input type="submit" name="submit_user" value="Yes" class=" btn btn-secondary">  
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
    </div>                                  
</form>