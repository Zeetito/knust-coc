<form action="" method="post">
    @csrf
        <div class="card-body modal-title" id="myModalLabel">
                    <h5 style="text-align:center">Sharing the something</h5>

                    <div class="h6">
                        {{-- {{$ministry->name}} --}}
                    </div>
        </div>

        <div class="modal-body">

          we go

        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>
