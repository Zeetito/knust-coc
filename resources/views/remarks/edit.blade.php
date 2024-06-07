<form action="{{route('update_remark_record',['remark_record'=>$remark_record])}}" method="post">
    @csrf
    @method('put')
        <div class=" m-2 modal-title" id="myModalLabel">
            <h6 style="text-align:center">Edit</h6>
        </div>
        <div class="modal-body">
            

            <strong>Note</strong>

            <input type="text" name="body" class="form-control" value="{{$remark_record->body}}">


        </div>
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Update" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>                                  
</form>