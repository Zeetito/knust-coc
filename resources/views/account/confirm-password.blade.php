<form action="{{route('account_new_password',['user'=>$user])}}">
    @csrf
        <div class="modal-title" id="myModalLabel">
            <h6 style="text-align:center">Confrim that this is you</h6>
        </div>

        <div class="modal-body form-group">
            
            <strong for="password">Enter Current Password</strong>
            <input class="form-control" type="password" autocomplete="off" name="password"   required placeholder="Password">
            @error('password')
            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
            @enderror

        </div>
        
        <div class="modal-footer mt-3">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
