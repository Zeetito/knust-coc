<x-layout>
    {{-- Whole Page Begins --}}
    <a href="{{route('ministry_account_sessions',$account->ministry)}}" class="btn-secondary btn float-right mr-2 mt-2">Go Back</a>
    <div class="card-body bg-white">

        <span class="h6">
            {{$ministry->name}}
        </span>
        <br>

        <span class="h6">
            Records - {{$account->name}}
        </span>



        {{-- Content whether empty-message or Table or list goes in here --}}
        <div class="card-body">

            @if($account->records == "[]")
                <span class="btn btn-info" data-url="{{route('create_ministry_account_record',['account'=>$account])}}" data-toggle="modal" data-target="#myModal" > 
                    New Record
                </span>

                <span class="h6">
                    No Records Made
                </span>

            @else

            <span class="btn btn-info" data-url="{{route('create_ministry_account_record',['account'=>$account])}}" data-toggle="modal" data-target="#myModal" > 
                New Record
            </span>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        
                        <th>Info</th>

                        <th>Value</th>

                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody id="search_result_for_account_list">

                    @foreach($account->records as $record)

                    <tr id="tr_{{$record->id}}">
                        <td>
                            {{$record->item}}
                        </td>
                        <td>
                            {{$record->info}}
                        </td>
                        <td>
                            {{$record->value}}
                        </td>
                        <td>
                            {{-- View Attendance Session --}}
                            <span class="btn" data-url="{{route('edit_account_record',['record'=>$record])}}" data-target="#myModal" data-toggle="modal" >
                                <i class="fa fa-pencil"></i>
                            </span>

                            <span class="btn" data-url="{{route('confirm_delete_account_record',['record'=>$record])}}" data-target="#myModal" data-toggle="modal" >

                                <i class="fa fa-trash"></i>
                            </span>

                        </td>
                    </tr>

                    @endforeach

                    @if($account->type == "calculate")
                    <tr>
                        <td>
                            
                        </td>
                        <td>
                            Average: {{$account->values_average()}} (per record)
                        </td>
                        <td>
                            Total: {{$account->values_sum()}} 
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                    @endif


                </tbody>

            </table>                

            @endif


            

        </div>

    </div>
    {{-- Whole Page ends --}}

</x-layout>