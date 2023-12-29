<x-layout>
      
        
    <div class="container-fluid">
            <div class="dashboard-container">

                {{-- Each Whole Table Screen --}}
                <div class="process-bar">
                    <div class="process-bar">
                        <div class="process-order">
                            <h3 style="text-align:center">Roles</h3>
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
                                                    <th>Role Name</th>
                                                    <th>Number of People</th>
                                                    <th>Description</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            {{-- Table Body --}}
                                            <tbody class="search_result">
                                                @foreach(App\Models\Role::all() as $role)

                                                <tr id="tr_{{$role->id}}">
                                                        {{-- Role Name --}}
                                                    <td>
                                                       {{$role->name}}
                                                    </td>
                                                    {{-- Number of Users --}}
                                                    <td>
                                                       {{$role->users->count()}}
                                                    </td>
                                                    
                                                    {{-- Description --}}
                                                    <td>
                                                       {{ $role->description != "" ? $role->description : "No Description" }}
                                                    </td>

                                                    {{-- Actions --}}
                                                    <td>
                                                        @allowedTo(['update_role'])
                                                        {{-- View/Update A Role --}}
                                                        <a href="{{route('edit_role',$role)}}">
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

                        {{-- {{$role->links()}} --}}
                       
                    </div>
                </div>
                {{-- Whole Table Screen Ends --}}

               


            </div> <!-- end of dashboard container -->

        </div>
        <!-- /.conainer-fluid -->

</x-layout>