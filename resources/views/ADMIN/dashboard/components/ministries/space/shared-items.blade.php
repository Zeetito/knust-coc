<x-layout>
      
    <div class="card-body">
        
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-toggle="tab"  role="tab" aria-controls="received">Received</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-toggle="tab"   role="tab" aria-controls="sent">Sent</button>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab"  role="tab" aria-controls="messages">Messages</a>
            </li> --}}
        </ul>

        
        
            
       

        {{-- Tab Div Begins --}}
        <div class="tab-content">
            {{-- Users Tab Begins --}}
            <div class="tab-pane active" id="received" role="tabpanel">
                @if($ministry->received_items != "[]")
                <div class="h6">Received Items</div>
                <table class="table table-striped">

                    {{-- Table Caption --}}
                        {{-- Table Head --}}
                        <thead>
                            <tr>
                                <th>Name</th>

                                <th>From</th>
                               
                                <th>Actions</th>
                            </tr>
                        </thead>
                        {{-- Table Body --}}
                        <tbody id="search_result_for_user_list">
                            @foreach($ministry->received_items as $item)
    
                            <tr id="tr_{{$item->id}}">
                                    {{-- user Name --}}
                                <td>
                                    {{$item->sharable->name}}
                                </td>
                                <td>
                                    {{$item->sendable->name}}
                                </td>

                                <td>
                                    {{-- View Attendance Session --}}
                                    <a class="btn" href="{{route('show_shared_item',['item'=>$item])}}" >
                                        <i class="fa fa-eye"></i>
                                    </a>
        
                                   
                                </td>



                                {{-- Number of Users --}}
                            </tr>
                        @endforeach
                        </tbody>
                        {{-- Table Body Ends --}}
                </table>
                @else
                <div>Nothing to show</div>
                @endif
            </div>
            {{-- Users Tab Ends --}}


            {{-- Permissions Tab Begins --}}
            <div class="tab-pane" id="sent" role="tabpanel">
                @if($ministry->sent_items != "[]")
                <table class="table datatable  table-striped">

                    {{-- Table Caption --}}
                        {{-- Table Head --}}
                        <div class="h6">Sent Items</div>
                        <thead>
                            <tr>
                                <th>Name</th>

                                <th>To</th>
                               
                                <th>Actions</th>
                            </tr>
                        </thead>
                        {{-- Table Body --}}
                        <tbody id="search_result_for_user_list">
                            @foreach($ministry->sent_items as $item)
    
                            <tr id="tr_{{$item->id}}">
                                    {{-- user Name --}}
                                <td>
                                    {{$item->sharable->name}}
                                </td>
                                <td>
                                    {{$item->receivable->name}}
                                </td>

                                <td>
                                    {{-- View Attendance Session --}}
                                    {{-- <a class="btn" href="{{route('show_shared_item',['item'=>$item])}}" > --}}
                                        {{-- <i class="fa fa-eye"></i> --}}
                                    {{-- </a> --}}
        
                                   
                                </td>



                                {{-- Number of Users --}}
                            </tr>
                        @endforeach
                        </tbody>
                        {{-- Table Body Ends --}}
                </table>
                @else
                <div>Nothing to show</div>
                @endif
            </div>
            {{-- Users Tab Ends --}}


            
            <div class="tab-pane" id="messages" role="tabpanel">
                3Messagess. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
            
            {{-- Tab Div ends --}}
        </div>
    </div>

</x-layout>