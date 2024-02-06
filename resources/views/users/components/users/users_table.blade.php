
<span  class="btn btn-info table_replace_button" data-url="{{route('users_table')}}" data-target="#table_replaceable" >Users Table</span>

<div>

    <table class="table datatable_print table-striped" >

        <thead>

            <th>Name</th>
            <th>Contact(s)</th>
            <th>Email</th>
            <th>Status</th>

        </thead>
        
        <tbody>

            @foreach(App\Models\User::all() as $user)

            <tr>
                <td>{{$user->fullname()}}</td>
                <td>{{$user->phone? "Phone: ".$user->phone->body : $user->when_guest()->contact}}</td>
                {{-- <td>Hello</td> --}}
                <td>{{$user->email}}</td>
                <td>{{$user->status()}}</td>
            </tr>


            @endforeach

        </tbody>

    </table>

</div>

<script src={{asset("js/custom.js")}}></script>

