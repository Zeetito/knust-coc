<x-layout>

    <div class="card-body bg-white">

        
        <div  class="overflow-scroll">
            
            <h6 >Birthday Reminders</h6>

            
            <table class="table datatable_print table-striped" >
                
                <thead>

                    <th>Name</th>
                    <th>Zone</th>
                    <th>Year</th>
                    <th>Phone</th>
                    <th>WhatsApp</th>
                    <th>Status</th>

                </thead>
                
                <tbody>

                    @foreach($users as $user)

                    <tr>
                        <td>{{$user->fullnames()}}</td>
                        <td>{{$user->member_biodata ? $user->zone()->name : "N/A"}}</td>
                        <td>{{$user->member_biodata ? $user->year() : "N/A"}}</td>
                        <td>{{$user->phone? $user->phone->body : ($user->when_guest() ? $user->when_guest()->contact : "None Given")}}</td>
                        <td>{{$user->whatsapp? $user->whatsapp->body :"None"}}</td>
                        {{-- <td>yes</td> --}}
                        <td>{{$user->status()}}</td>
                    


                    </tr>


                    @endforeach

                </tbody>

            </table>

        </div>
    </div>
</x-layout>


