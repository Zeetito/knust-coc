<form action="{{route('dtd_delete',['dtd'=>$dtd])}}" method="post">
    @csrf
    @method('delete')
        <div class="modal-title" id="myModalLabel">
            <h6 style="text-align:center">You are Deleting {{$dtd->name}}</h6>
        </div>

        <div class="modal-body form-group">
          <strong>Confirm</strong>
          <select name="response" id="" required>
            <option value="">Select</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
        </div>    
        
        <div class="modal-footer mt-3">
            <input type="submit"  value="Delete" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>      
</form>
