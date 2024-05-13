<x-layout>
    {{-- Whole Page Begins --}}
    @if(auth()->user()->hasRole($account->ministry->slug))
        <a href="{{route('ministry_account_sessions',['ministry'=>$account->ministry,'semester'=>$semester] )}}" class="btn-secondary btn float-right mr-2 mt-2">Go Back</a>
    @endif
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

            @if(auth()->user()->hasRole($account->ministry->slug))
            <span class="btn btn-info" data-url="{{route('create_ministry_account_record',['account'=>$account])}}" data-toggle="modal" data-target="#myModal" > 
                New Record
            </span>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        
                        <th>Info</th>

                        <th>Value</th>

                        @if(auth()->user()->hasRole($account->ministry->slug))
                        <th>Actions</th>
                        @endif
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
                            {{$record->value}} @if($account->type == "calculate") {{$record->sign == 'p' ? "(+)" : "(-)"}} @endif
                        </td>

                        @if(auth()->user()->hasRole($account->ministry->slug))
                        <td>
                            {{-- View Attendance Session --}}
                            <span class="btn" data-url="{{route('edit_account_record',['record'=>$record])}}" data-target="#myModal" data-toggle="modal" >
                                <i class="fa fa-pencil"></i>
                            </span>

                            <span class="btn" data-url="{{route('confirm_delete_account_record',['record'=>$record])}}" data-target="#myModal" data-toggle="modal" >

                                <i class="fa fa-trash"></i>
                            </span>
                        </td>
                        @endif
                        
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