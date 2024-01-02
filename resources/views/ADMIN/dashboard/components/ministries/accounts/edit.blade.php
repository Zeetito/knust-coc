<form action="{{route('update_ministry_account_session',['account'=>$account])}}" method="post">
    @method('put')
    @csrf
        <div class="card-body modal-title" id="myModalLabel">
                    <h5 style="text-align:center">Editing Account Session</h5>

                    <div class="h6">
                        {{$ministry->name}}
                    </div>
        </div>

        <div class="modal-body">

            <strong>Name Of Session</strong>
            <input type="text" name="name" class="form-control" value="{{$account->name}}" required>

    

        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
