
{{-- Form Begins --}}
<div class="card-body bg-danger" >
    <form action="{{route('delete_user',['user'=>$user])}}" method="post">
        @method('delete')
        @csrf

        <div class="row">
            <div class="justify-content-center col-12 h6">You're Deleting {{$user->fullname()}}'s Account. 
                <span class="float-right bg-info btn">Deactivate Instead</span>
            </div>

            <strong>Confirm that It is You.</strong>

            {{-- <span class="col-10"> --}}
                <input type="password" class="col-12 form-control mb-2 "  name="password" placeholder="Password" required> 
            {{-- </span> --}}
            {{-- <i  class="password-toggle col-2 btn fa fa-eye"></i> --}}
            

            <input class="form-control" type="submit" value="Delete">

        </div>
            
    </form>
</div>
