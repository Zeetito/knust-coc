<form action="{{route('delete_remark',['remark'=>$remark])}}" method="post">
    @csrf
    @method('delete')
        <div class=" m-2 modal-title" id="myModalLabel">
            <h6 style="text-align:center">Deleting this remark</h6>
        </div>
        <div class="modal-body">
            

            <strong>Note</strong>

            <input type="text" name="body" class="form-control" value="{{$remark->body}}" readonly>


        </div>
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Delete" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>                                  
</form>