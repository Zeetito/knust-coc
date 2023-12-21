@foreach($users as $user)

<div class="col-sm-4 col-md-4 mt-3">
    {{-- If User is Ill --}}
    
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                    <i>
                        <a href="{{route('view_profile', $user)}}">
                            <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                        </a>
                    </i>
                </div>
                <small class="text-uppercase font-weight-bold">Name: {{$user->fullname()}}</small> <br>
                
                <small class="text-uppercase font-weight-bold">Status: {{$user->status()}}</small> <br>
                <small class="text-uppercase font-weight-bold">Residence: {{$user->residence()?  $user->residence()->name : "None"}}</small><br>
                
                @if($user->hasAnyRole())
                <small class="text-uppercase font-weight-bold">Roles: @foreach($user->roles as $role){{$role->name}}, @endforeach </small>
                
                @endif

                <div class="progress progress-white progress-xs mt-3">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>

</div>

@endforeach