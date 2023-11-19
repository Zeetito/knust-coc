<form action="{{route('delete_meeting',['meeting'=>$meeting])}}" method="post">
    @csrf
    @method('delete')
        <div class="modal-title" id="myModalLabel">
            <h5 style="text-align:center">Delete Meeting</h5>
        </div>

        <div class="modal-body form-group">
            <p>Do you really want to delete <strong>{{$meeting->name}}</strong> </p>
        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Yes" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
