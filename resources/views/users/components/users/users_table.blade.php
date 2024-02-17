
<span  class="btn btn-info table_replace_button" data-url="{{route('users_table')}}" data-target="#table_replaceable" >Users Table</span>

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

            <tr>
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

                </td>
            </tr>


            @endforeach

        </tbody>

    </table>

</div>

<script src={{asset("js/custom.js")}}></script>

