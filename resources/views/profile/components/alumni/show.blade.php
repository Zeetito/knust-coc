<x-layout>

    {{-- If User Has Profile Details --}}

    @if(!empty($user->biodata))

    <div class="row" style="justify-items:center">
        <div class="col-12 bg bg-white" >

         User: {{ $user->fullname()}}

            {{-- User Avatar --}}
            <div class="nav-link" >
                <img src="{{$user->get_avatar()}}" class="img-avatar" alt="Profile Picture"/>
                {{-- Edit User Avatar --}}
                @can("update",$user)
                <a href="{{route( 'edit_avatar_form',['user'=>$user] )}}">
                    <span style="position:absolute" class=""><i title="change Profile picture" class="fa fa-pencil"></i></span>
                </a>
                @endcan

            </div>

            
            <div class="card-body">
                About <strong> {{$user->username}} </strong>
                <div class="card border-primary">
                    <div class="card-header">
                    <i class="fa fa-user"></i><strong>{{$user->status()}}</strong>
                    {{-- Update User Profile --}}
                        @can("update",$user)
                        <a class="btn" href="{{route('edit_user_profile_form', ['user'=>$user])}}">
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
                            <li>
                                Gender: {{$user->gender == 'm'? 'Male':'Female'}}
                            </li>
                            
                            {{-- Loop To List the othername(s)  a user has --}}

                            <li>
                                Country: {{$user->biodata->country}}
                            </li>

                            <li>
                                State: {{$user->biodata->state}}
                            </li>

                            <li>
                                City: {{$user->biodata->city}}
                            </li>

                            <li>
                                Local Congregation: {{$user->biodata->local_congregation}}
                            </li>
                        </ul>
                    </div>
                </div>

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