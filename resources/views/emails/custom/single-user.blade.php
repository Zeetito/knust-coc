<form action="{{route('send_email')}}" method="post">
    @csrf
        <div class="modal-title" id="myModalLabel">
        </div>

        <h5 style="text-align:center">Sending Custom Email to {{$user->fullname()}}</h5>

        <div class="modal-body form-group">

            <strong>User Email</strong>
            <input required type="email" class="form-control" name="to" value="{{$user->email}}" > <br>
         
            <strong>Subject</strong>
            <input required type="text" name="subject" class="form-control"> <br>

            <Strong>Body</Strong>
            <textarea required type="text" class="form-control"  name="body">
            </textarea>

        </div>
        
        <div class="modal-footer mt-3">
            <input type="submit" name="submit_user" value="Send" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>                                  
</form>
