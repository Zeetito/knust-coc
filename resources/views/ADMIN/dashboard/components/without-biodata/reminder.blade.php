<form action="#" method="post">
    @csrf
        <div class="modal-title" id="myModalLabel">
                    <h5 style="text-align:center">Remind {{$user->fullname()}} to complete their profile</h5>
        </div>

        <div class="modal-body">
                <div class="h1">
                    <i>
                        <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                    </i>
                </div>

               

                {{-- INPUTS --}}
                <div calss="form-group">
                    <label class="form" for="is_activated">Email</label>
                    <input class="form-control" type="text" value="{{$user->email}}" name="email" required readonly id="email">


                    <label class="form" for="subject">Subject</label>
                    <input class="form-control" type="text" value="PROFILE UPDATE" name="subject" required readonly id="subject">
                    
                    <label class="form" for="body">Subject</label>
                    <textarea class="form-control" type="text" name="body" required readonly id="body">
                        Dear {{$user->fullname()}} You are being reminded by the Leadership of KNUST COC that you have not completed your profile/details. Kindly Login and do so right away with the link below.
                        
                        {{route("login")}}
                    </textarea>

                    
                </div>
        </div>
        
        <div class="modal-footer">
            <input type="submit" class="form-control" name="submit_user" value="Save" class=" btn btn-secondary">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>                                  
</form>