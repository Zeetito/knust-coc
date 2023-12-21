
<div class="row">
    @if($dtd->groups != "[]")
        <div class="col-12 bg-info">Sub-Groups Under This Session</div>
        @foreach($dtd->groups as $group)
            @if(auth()->user()->is_member_of($group))
                <div class="col-12 bg-secondary mb-1">{{$group->name}} <a class="btn fa fa-eye" href="{{route('show_group',['group'=> $group])}}">My Group</a>
            @else
                <div class="col-12 bg-secondary mb-1">{{$group->name}} <a class="btn fa fa-eye" href="{{route('show_group',['group'=> $group])}}"></a>
            @endif
                <span>Info: {{$group->info? $group->info:"None"}}</span>
            </div>
        @endforeach
    @else
        <div class="col-12">This Session Has no sub-Groups</div>
    @endif

</div>