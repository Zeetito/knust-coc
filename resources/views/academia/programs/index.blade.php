<x-layout>
      
        
    <div class="container-fluid">
            <div class="dashboard-container">

                {{-- Each Whole Table Screen --}}
                <div class="process-bar">
                    <div class="process-bar">
                        <div class="process-order">
                            <h3 style="text-align:center">Programs</h3>

                        </div>

                        <span class="btn btn-info float-right" data-target="#myModal" data-toggle="modal" data-url="{{route('create_program')}}">Add New Program</span>

                        {{--  Table --}}
                        <div class="" >

                                <div class="card-body">
                                        <table class="table datatable table-striped">
                                            {{-- Table Head --}}
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>College</th>
                                                    <th>Type</th>
                                                    <th>Students</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            {{-- Table Body --}}
                                            <tbody class="search_result">
                                                @foreach(App\Models\Program::all() as $program)

                                                <tr id="tr_{{$program->id}}">
                                                        {{-- Program Name --}}
                                                    <td>
                                                       {{$program->name}}
                                                    </td>
                                                        {{-- College --}}
                                                    <td>
                                                       {{$program->college->name}}
                                                    </td>
                                                    {{-- Type --}}
                                                    <td>
                                                       {{ $program->type == "ug"? "UnderGraduate":"PostGraduate" }}
                                                    </td>
                                                    {{-- Number of Users --}}
                                                    <td>
                                                       {{$program->users()->count()}}
                                                    </td>
                                                    

                                                    {{-- Actions --}}
                                                    <td>
                                                    

                                                        @allowedTo(['delete_program'])
                                                         {{-- Delete A Role --}}
                                                         <a href="#">
                                                            <i class="fa fa-trash"></i>
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