<x-layout>

    <div class="card-body">

    

        <div  class="overflow-scroll">

            <table class="table datatable_print table-striped" >

                <thead>

                    <th>Name</th>
                    <th>Phone</th>
                    <th>WhatsApp</th>
                    <th>Email</th>
                    <th>Status</th>

                </thead>
                
                <tbody>

                    @foreach($users as $user)

                    <tr>
                        <td>{{$user->fullnames()}}</td>
                        <td>{{$user->phone? $user->phone->body : ($user->when_guest() ? $user->when_guest()->contact : "None Given")}}</td>
                        <td>{{$user->whatsapp? $user->whatsapp->body :"None"}}</td>
                        {{-- <td>yes</td> --}}
                        <td>{{$user->email}}</td>
                        <td>{{$user->status()}}</td>
                    


                    </tr>


                    @endforeach

                </tbody>

            </table>

        </div>
    </div>
</x-layout>


