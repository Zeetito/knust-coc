
<div class="row card-body">
    @if($dtd->groups != "[]")
        <div class="col-12 h6">Sub-Groups Under This Session</div>
        @if(auth()->user()->is($dtd->creator()))
        <span class="btn btn-info mr-2 float-right mb-2 col-12" data-toggle="modal" data-target="#myLargeModal" data-url="{{route('dtd_subgroup_create',['dtd'=>$dtd])}}" >
            Create Sub-Group
        </span>
        @endif
        
        <br/>
        @foreach($dtd->groups as $group)
            @if(auth()->user()->is_member_of($group))
                <div class="bg-secondary col-12 mb-1">{{$group->name}} <a class="btn text-white fa fa-eye" href="{{route('show_group',['group'=> $group])}}"><strong>My Group</strong></a>
                {{-- Admin Tools --}}
                    @if(auth()->user()->is_admin_for($group))
                        <span title="Edit Group" data-toggle="modal" data-target="#myLargeModal" data-url="{{route('edit_group',['group'=>$group])}}"  >
                            <i class="fa fa-pencil"></i>
                        </span>
                    @endif
                {{-- Creator tools --}}
                @if(auth()->user()->is_creator_for($group) || auth()->user()->is($dtd->creator()))
                <span title="Delete Group" data-toggle="modal" data-target="#myLargeModal" data-url="{{route('confirm_group_delete',['group'=>$group])}}"  >
                    <i class="fa fa-trash"></i>
                </span>
                @endif




            @else
                    <div class="col-12 bg-secondary mb-1">{{$group->name}} <a class="btn fa fa-eye" href="{{route('show_group',['group'=> $group])}}"></a>
            @endif
            <br>
                <span>Info: {{$group->info? $group->info:"None"}}</span>


            </div>


        @endforeach
    @else
        <div class="col-12">This Session Has no sub-Groups</div>
        @if(auth()->user()->is($dtd->creator()))
        <span class="btn btn-info mr-2 float-right mb-2" data-toggle="modal" data-target="#myLargeModal" data-url="{{route('dtd_subgroup_create',['dtd'=>$dtd])}}" >
            Create Sub-Group
        </span>
        @endif
    @endif

</div>