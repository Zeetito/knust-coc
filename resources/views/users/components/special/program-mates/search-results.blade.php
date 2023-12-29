@if($mates == "[]")

<div class="col-sm-3 col-md-2 mt-3">
  
    <span class="h5">No Results Found</span>

</div>
@else

@foreach($mates as $mate)
    <div class="col-sm-3 col-md-2 mt-3">
        {{-- If User is a Fresher --}}

        {{-- @if($user->inactive_account_reason() == 'fresher') --}}
        <div class="card text-white bg-info" data-toggle="" data-target="#myModal" >
            <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                    <i>
                        <a href="{{route('view_profile', $mate)}}">
                            <img src="{{$mate->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                        </a>
                    </i>
                </div>
                {{-- <div class=" mb-0">{{$mate->created_at->diffInDays(now())}} Days Ago</div> --}}
                <small class="text-uppercase font-weight-bold">Name: {{$mate->fullname()}} </small><br>
                <small class="text-uppercase font-weight-bold">Year: {{$mate->year()}} </small><br>
            </div>
        </div>

        {{-- @endif --}}


    </div>
@endforeach

@endif