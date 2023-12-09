@foreach($mates as $mate)
<div class="col-sm-3 col-md-2 mt-3">
    {{-- If User is a Fresher --}}

    {{-- @if($user->inactive_account_reason() == 'fresher') --}}
    <a class="card text-white bg-info" data-toggle="modal" data-target="#myModal"  >
        <div class="card-body">
            <div class="h1 text-muted text-right mb-4">
                <i>
                    <img src="{{$mate->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                </i>
            </div>
            {{-- <div class=" mb-0">{{$mate->created_at->diffInDays(now())}} Days Ago</div> --}}
            <small class="text-uppercase font-weight-bold">{{$mate->fullname()." - Year : ".$mate->year()}} </small>
            
            <div class="progress progress-white progress-xs mt-3">
                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </a>

    {{-- @endif --}}
</div>
@endforeach