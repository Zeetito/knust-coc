<form action="{{route('delete_account_record',['record'=>$record])}}" method="post">
    @csrf
    @method('delete')
        <div class="card-body modal-title" id="myModalLabel">
                    <h5 style="text-align:center">Deleting This Record</h5>

                    <div class="h6">
                        {{$record->account_session->name}}
                    </div>
        </div>

        <div class="modal-body">
            <strong>Name</strong>
            <input type="text" name="item" class="form-control" value="{{$record->item}}" readonly>

            <strong>Info</strong>
            <input type="text" name="info" class="form-control" value="{{$record->info}}" readonly>


            <strong>Value</strong>
            <input type="text" name="value" class="form-control" value="{{$record->value}}" readonly>
            
        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Delete" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>                                  
</form>
