<x-layout>
      
        
    <div class="container-fluid">
            <div class="dashboard-container">

                {{-- Each Whole Table Screen --}}
                <div class="process-bar">

                    <a  class="btn btn-info table_replace_button" href="{{route('view_users')}}">Back</a>

                    <div  class="overflow-scroll">
                    
                        <table class="table datatable_print table-striped" >
                    
                            <thead>
                    
                                <th>Name</th>
                                <th>Contact(s)</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                    
                            </thead>
                            
                            <tbody>
                    
                                @foreach(App\Models\User::all() as $user)
                    
                                <tr id="tr_{{$user->id}}">
                                    <td>{{$user->fullname()}}</td>
                                    {{-- <td>{{$user->phone? "Phone: ".$user->phone->body : $user->when_guest()->contact}}</td> --}}
                                    <td>yes</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                    <td>
                                        @allowedTo(['update_user'])
                                            <a class="bg-danger btn mt-1"  data-target="#myModal" data-toggle="modal" data-url="{{route('confirm_delete_user',['user'=>$user])}}"><i class="fa fa-trash"></i></a>
                                            <a class="bg-secondary btn mt-1"  href="{{route('edit_user',['user'=>$user])}}"><i class="fa fa-pencil"></i></a>
                                            <a class="bg-secondary btn mt-1" data-toggle='modal' data-target="#myModal" data-url="{{route('custom_email_single_user',['user'=>$user])}}" href="#"><i class="fa fa-envelope-square"></i></a>
                    
                                        @endallowedTo
                    
                                        @if($attendance)
                                            @if($user->is_checked($attendance))
                                                @can('check',$user)
                                                    {{-- Uncheck User button --}}
                                                    <span type="button" data-toggle="modal" data-target="#myModal" id="{{$user->id}}"  data-url="{{route('confirm_uncheck_user',['attendance'=>$attendance , 'user'=>$user])}}" >
                                                        <i class="text-success fa fa-check"></i>
                                                    </span> 
                                                    @else
                                                    {{-- Not A button --}}
                                                    <span type="button" class="button message"  >
                                                        <i class="text-success fa fa-check"></i>
                                                    </span>
                                                @endcan
                    
                                                @else
                                                {{-- Check User Button --}}
                                                @can('check',$user)
                                                <button class="check_button" id="{{$user->id}}" data-url="{{route('check_user',['attendance'=>$attendance , 'user'=>$user])}}" >
                                                    <i class=" text-danger fa fa-check"></i>
                                                </button>
                    
                                                @else
                    
                                                <button class="" id="{{$user->id}}" data-url="" >
                                                        <i class=" text-info fa fa-check"></i>
                                                </button>
                                                @endcan
                    
                                             @endif
                    
                                        @endif
                    
                                    </td>
                    
                    
                    
                                </tr>
                    
                    
                                @endforeach
                    
                            </tbody>
                    
                        </table>
                    
                    </div>
                    
                    <script src={{asset("js/custom.js")}}></script>
                    
                    
                </div>

    </div>
        <!-- /.conainer-fluid -->

</x-layout>