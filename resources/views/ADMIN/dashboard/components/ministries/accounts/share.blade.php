<x-layout>
<form action="{{route('store_share')}}" method="post">
    @csrf
        <div class="card-body " id="myModalLabel">
                    <h5 style="text-align:center">Sharing {{$account->name}}</h5>

                    <div class="h6">
                        {{-- {{$ministry->name}} --}}
                    </div>
        </div>

        <div class="bg-white card-body pre-scrollable">
            <div class="h6">Share with?</div>

            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-toggle="tab"  role="tab" aria-controls="users">Users</button>
                </li>

                <li class="nav-item">
                    <button class="nav-link" data-toggle="tab"   role="tab" aria-controls="ministry">Ministry</button>
                </li>

            </ul>

            {{-- Users Tab --}}
            <div role="tabpanel"id="users"  class="tab-pane active">
                <table   class="table  datatable table-striped ">
                    {{-- Table Head --}}
                  
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    {{-- Table Body --}}
                    <tbody class="search_result">
                        @foreach(App\Models\User::all() as $user)

                        <tr id="tr_{{$user->id}}">
                                {{-- user Name --}}
                            <td>
                                {{$user->fullname()}}
                            </td>
                            
                            <td>
                                <input type="checkbox"  name="users[]" value="{{$user->id}}">
                            </td>
                            {{-- Number of Users --}}
                        </tr>
                    @endforeach

                    </tbody>
                    {{-- Table Body Ends --}}
                </table>
            </div>


            <div id="ministry" class="tab-pane" role="tabpanel">
                @foreach(App\Models\Role::all()  as $role)
                <li>
                    <input value="{{$role->id}}" name="ministry[]" type="checkbox">{{$role->name}}
                </li>
                @endforeach
            </div>


            <input name="sharable_id" value="{{$account->id}}" type="text" hidden>
            <input name="sharable_type" value="{{$sharable_type}}" type="text" hidden>
            <input name="sendable_id" value="{{$ministry->id}}" type="text" hidden>
            <input name="sendable_type" value="{{$sendable_type}}" type="text" hidden>


        </div>
        
        <div class="modal-footer">
            <input type="submit" name="submit_user" value="Save" class=" btn btn-secondary">  
            <a type="button" href="{{route('ministry_account_sessions',['ministry'=>$ministry])}}" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
        </div>                                  
</form>
</x-layout>