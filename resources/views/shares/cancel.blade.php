<form action="{{route('cancel_share',['item'=>$item])}}" method="post" class="card-body">
    @csrf
    @method('delete')
        <div class="modal-title" id="myModalLabel">
                    <h5 style="text-align:center">Stop Sharing.</h5>

                    <div class="h6">
                        Name: {{$item->sharable->name}}
                    </div>
        </div>

        <div class="modal-body">

            Do you want to stop sharing this with {{$item->receivable->name}}

            <select class="form-control" name="response" id="">
                <option value="">Select</option>
                <option value="1">Proceed</option>
                <option value="0">Ignore</option>
            </select>

        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Confirm" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
