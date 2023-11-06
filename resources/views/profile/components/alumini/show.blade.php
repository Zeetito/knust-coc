<x-layout>

    {{-- If User Has Profile Details --}}

    @if(!empty($user->profile()))

    <div class="row" style="justify-items:center">
        <div class="col-sm-6 col-md-12" style="margin-left:16px;background-color:white">

         User: {{ $user->fullname()}}

            {{-- User Avatar --}}
            <div  style="border-color:blue; border-width:5px"  class="nav-link nav-link" data-toggle="dropdown" href="{{route('view_profile',auth()->user()->id)}}" role="button" aria-haspopup="true" aria-expanded="false">
                <img src="{{$user->get_avatar()}}" class="img-avatar" alt="Profile Picture"/>
                {{-- Edit User Avatar --}}
                @can("update",$user)
                <a href="{{route( 'edit_avatar_form',$user->id )}}">
                    <span style="position:absolute; margin-top:25px;" class=""><i title="change Profile picture" class="fa fa-pencil"></i></span>
                </a>
                @endcan

            </div>

            
            <div class="row">
                    <div class="col-sm-6 col-md-6">
                        About <strong> {{$user->username}} </strong>
                            <div class="card border-primary">
                                <div class="card-header">
                                <i class="fa fa-user"></i><strong>{{$user->status()}}</strong>
                                {{-- Update User Profile --}}
                                    @can("update",$user)
                                    <a class="btn" href="{{route('edit_user_profile_form', $user->id)}}">
                                        <span class="badge badge-success float-right">
                                            Edit Profile
                                        </span>
                                    </a>
                                    @endcan

                                </div>

                                <div class="card-body">
                                        <ul>
                                            <li>
                                                FirstName: {{$user->firstname}}
                                            </li>
                                            <li>
                                                LastName: {{$user->lastname}}
                                            </li>
                                            <li>
                                                OtherName(s): {{$user->othername}}
                                            </li>

                                                                                        </li>
                                            <li>
                                                Gender: {{$user->gender == 'm'? 'Male':'Female'}}
                                            </li>
                                            
                                            {{-- Loop To List the othername(s)  a user has --}}

                                            <li>
                                                Country: {{$user->biodata()->country}}
                                            </li>

                                            <li>
                                                State: {{$user->biodata()->state}}
                                            </li>

                                            <li>
                                                City: {{$user->biodata()->city}}
                                            </li>

                                            <li>
                                                Local Congregation: {{$user->biodata()->local_congregation}}
                                            </li>
                                        </ul>
                                </div>
                            </div>
                    </div>
                    {{--                     
                    <div class="col-sm-6 col-md-6">
                        About <strong> {{$user->username}} </strong>
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-user"></i>Card with icon
                                </div>
                                <div class="card-body">
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex
                                    ea commodo consequat.
                                </div>
                            </div>
                    </div> --}}
                    
            
            </div>
            
        </div>
    </div>
    
    {{-- If User Has No Profile Details --}}
    @else
    <div class="row" style="justify-items:center">
            <div class="col-sm-6 col-md-8">
                <div class="card border-warning">
                    <div class="card-header">
                        No Info To Show
                    </div>
                    <div class="card-body">

                        @can('update',$user)
                            <span class="title">
                                Help Us Know more about You.
                            </span>

                            <a href="{{route('create_user_profile_form',['user'=>$user])}}">
                                <button class="btn btn-primary">
                                    Complete Profile
                                </button>
                            </a>
                      

                        @endcan

                    </div>
                </div>
            </div>
            <!--/.col-->
           
    </div>
    @endif

</x-layout>