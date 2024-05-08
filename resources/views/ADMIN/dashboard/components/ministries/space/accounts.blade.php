<x-layout>
    {{-- Whole Page Begins --}}
    <div class="card-body bg-white">
        <span class="h5">
            {{$ministry->name}} Account Sessions. 
        </span>

        <a href="{{route('ministry_account_sessions_semesters',['ministry'=>$ministry, 'semester'=>$semester])}}" class="btn-secondary btn float-right">Go Back</a>

        {{-- Content whether empty-message or Table or list goes in here --}}
        <div class="card-body">

            
            @if($ministry->account_sessions == "[]")
    
                <span class="btn btn-info" data-url="{{route('create_ministry_account_session',['ministry'=>$ministry])}}" data-toggle="modal" data-target="#myModal" > 
                    Create New Account Session
                </span>
                <span class="h6">
                    No Active Accounts in Session
                </span>


            @else
                <span class="btn btn-info mb-2" data-url="{{route('create_ministry_account_session',['ministry'=>$ministry])}}" data-toggle="modal" data-target="#myModal" > 
                    Create New Account Session
                </span>
                <table class="table datatable table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody id="search_result_for_account_list">
                        @foreach($ministry->accounts_for($semester) as $session)

                        <tr id="tr_{{$session->id}}">
                            <td>
                                {{$session->name}}
                            </td>
                            <td>
                                {{-- View Attendance Session --}}
                                <a class="btn" href="{{route('show_ministry_account_session',['ministry'=>$ministry, 'account'=>$session])}}">
                                    <i class="fa fa-key"></i>
                                </a>
                                
                                <a class="btn" href="{{route('share_account_sessions',['sendable'=>'App\Models\Role', 'ministry'=>$ministry, 'account'=>$session])}}">
                                {{-- <span class="btn" data-url="" data-target="#myLargeModal" data-toggle="modal" > --}}
                                    <i class="fa fa-share-alt"></i>
                                </a>

                                <span class="btn" data-url="{{route('edit_ministry_account_session',['account'=>$session,'ministry'=>$ministry])}}" data-target="#myModal" data-toggle="modal" >

                                    <i class="fa fa-pencil"></i>
                                </span>

                                <span class="btn" data-url="{{route('confirm_delete_ministry_account_session',['account'=>$session])}}" data-target="#myModal" data-toggle="modal" >

                                    <i class="fa fa-trash"></i>
                                </span>

                            </td>
                        </tr>

                        @endforeach
                    </tbody>



                </table>

            @endif

        </div>

    </div>
    {{-- Whole Page ends --}}

</x-layout>