<form action="" method="post">
    @csrf
        <div class="modal-title" id="myModalLabel">
            <h5 style="text-align:center">Uploading A File</h5>
        </div>

        <div class="modal-body form-group">
            
            <input class="form-control" type="file" name="pdf_file">
            <button type="submit">Upload PDF</button>

            <input type="text" name="type" value="{{$type}}" hidden>
            <input type="text" name="uploadable_type" value="{{$uploadable_type}}" hidden>
            <input type="text" name="uploadable_id" value="{{$uploadable_id}}" hidden>


        </div>
        
        <div class="modal-footer mt-3">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
