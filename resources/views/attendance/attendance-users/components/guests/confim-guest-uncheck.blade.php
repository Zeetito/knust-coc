<form action="{{route('uncheck_guest',['attendance'=>$attendance , 'guest'=>$guest])}}" method="post">
    @csrf
    @method('delete')
        <div class="modal-title" id="myModalLabel">
            <span style=" ">
                    <h4 style="text-align:center">Confirm</h4>
        </div>
        <div class="modal-body">
            {{-- Geust Name --}}
            <p>Are you sure you want to Uncheck {{$guest->fullname}}  </p>

           

            <input type="checkbox" name="status" value="user" hidden checked>

        </span>
        <br>

    </div>
    <div class="modal-footer">
        <input type="submit" name="submit_user" value="Yes" class="btn btn-secondary">  
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
    </div>                                  
</form>