<x-layout>
      
        
    <div class="">
            <div class="dashboard-container">

                {{-- Each Whole Table Screen --}}
                <div class="process-bar">
                    <div class="process-bar">
                        <div class="process-order">
                            <h3 style="text-align:center">Permissions</h3>
                            <span>
                                    <form >
                                        <input type="text" class="search_box" data-url="" placeholder="search name..." style="text-align:center;">
                                            <i class="fa fa-search"></i>
                                    </form>
                            </span>
                        </div>

                        {{-- Attendance Table --}}
                        <div class="" >

                                <div class="card-body">
                                        <table class="table table-striped">
                                            {{-- Table Head --}}
                                            <thead>
                                                <tr>
                                                    <th>Permission Name</th>
                                                    {{-- <th>Number of People</th> --}}
                                                    <th>Description</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            {{-- Table Body --}}
                                            <tbody class="search_result">
                                                @foreach(App\Models\Permission::all() as $permission)

                                                <tr id="tr_{{$permission->id}}">
                                                        {{-- permission Name --}}
                                                    <td>
                                                       {{$permission->name}}
                                                    </td>
                                                    {{-- Number of Users --}}
                                                    {{-- <td>
                                                       {{$permission->users->count()}}
                                                    </td> --}}
                                                    
                                                    {{-- Description --}}
                                                    <td>
                                                       {{ $permission->description != "" ? $permission->description : "No Description" }}
                                                    </td>

                                                    {{-- Actions --}}
                                                    <td>
                                                        @allowedTo(['update_permission'])
                                                        {{-- View/Update A permission --}}
                                                        <a href="{{route('edit_permission',['permission'=>$permission])}}">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        @endallowedTo

                                                    </td>



                                                   
                                                </tr>
                                              @endforeach

                                            </tbody>
                                            {{-- Table Body Ends --}}
                                        </table>
                                       
                                </div>
                        
                         
                        </div>
                        {{--Users Table Ends--}}

                        {{-- {{$permission->links()}} --}}
                       
                    </div>
                </div>
                {{-- Whole Table Screen Ends --}}

               


            </div> <!-- end of dashboard container -->

        </div>
        <!-- /.conainer-fluid -->

</x-layout>