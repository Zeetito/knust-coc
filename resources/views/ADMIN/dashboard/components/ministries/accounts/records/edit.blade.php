<form action="{{route('update_account_record',['record'=>$record])}}" method="post">
    @csrf
    @method('put')
        <div class="card-body modal-title" id="myModalLabel">
                    <h5 style="text-align:center">Editing This Record</h5>

                    <div class="h6">
                        {{$record->account_session->name}}
                    </div>
        </div>

        <div class="modal-body">
            <strong>Name</strong>
            <input type="text" name="item" class="form-control" value="{{$record->item}}" required>

            <strong>Info</strong>
            <input type="text" name="info" class="form-control" value="{{$record->info}}" required>


            <strong>Value</strong>
            <input type="text" name="value" class="form-control" value="{{$record->value}}" required>
            
        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
