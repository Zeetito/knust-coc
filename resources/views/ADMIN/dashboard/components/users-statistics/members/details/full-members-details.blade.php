
<x-layout>
    {{-- <span  class="btn btn-info table_replace_button" data-url="{{route('users_table')}}" data-target="#table_replaceable" >Users Table</span> --}}
    
    <div  class="overflow-scroll bg-white">
    
        <table class="table datatable_print table-striped" >
            <caption>VISITATION GUIDE</caption>
    
            <thead>
    
                <th>Name</th>
                <th>Status</th>
                <th>Active Contact</th>
                <th>WhatsApp</th>
                <th>Residence</th>
                <th>Zone</th>
                <th>Program</th>
                <th>Year</th>
                <th>Room</th>
                <th>Gurardian </th>
                <th>Relation</th>
                {{-- <th>Gurardian B</th> --}}
                <th>Action</th>
    
            </thead>
            
            <tbody>
    
                @foreach(App\Models\User::members()->get() as $user)
    
                <tr>
                    <td>{{$user->fullnames()}}</td>
                    <td>{{$user->status()}}</td>
                    <td>{{$user->phone? $user->phone->body : ($user->when_guest() ? $user->when_guest()->contact : "n/a")}}</td>
                    {{-- <td>yes</td> --}}
                    <td>{{$user->whatsapp? $user->whatsapp->body : "n/a"}}</td>
                    <td>{{$user->member_biodata ?( $user->residence() ? $user->residence()->name : "n/a") : "n/a"}}</td>
                    <td>{{$user->residence()? ($user->zone() ? $user->zone()->name : "n/a") : "n/a"}}</td>
                    <td>{{$user->member_biodata ?( $user->program() ? $user->program()->name : "n/a") : "n/a"}}</td>
                    <td>{{$user->biodata ? $user->year() : "n/a"}}</td>
                    <td>{{$user->member_biodata ? $user->member_biodata->room : "n/a"}}</td>
                    <td>{{$user->main_guardian_contact ?  $user->main_guardian_contact->body : "n/a"}}</td>
                    <td>{{$user->main_guardian_contact ? $user->main_guardian_contact->relation : "n/a"}}</td>
                    {{-- <td>{{$user->other_guardian_contact() ? $user->other_guardian_contact()->body : "n/a"}}</td> --}}
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
    
    {{-- <script src={{asset("js/custom.js")}}></script> --}}
    
    </x-layout>