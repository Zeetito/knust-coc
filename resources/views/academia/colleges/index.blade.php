<x-layout>
      
        
        <div class="container-fluid">
                <div class="dashboard-container">
    
                    {{-- Each Whole Table Screen --}}
                    <div class="process-bar">
                        <div class="process-bar">
                            <div class="process-order">
                                <h3 style="text-align:center">Colleges</h3>
                                <span>
                                        {{-- <form >
                                            <input type="text" class="search_box" data-url="" placeholder="search name..." style="text-align:center;">
                                                <i class="fa fa-search"></i>
                                        </form> --}}
                                </span>
                            </div>
    
                            {{--  Table --}}
                            <div class="pre-scrollable" >
    
                                    <div class="card-body">
                                            <table class="table table-striped">
                                                {{-- Table Head --}}
                                                <thead>
                                                    <tr>
                                                        <th>College Name</th>
                                                        <th>People</th>
                                                        <th>Programs</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                {{-- Table Body --}}
                                                <tbody class="search_result">
                                                    @foreach(App\Models\College::all() as $college)
    
                                                    <tr id="tr_{{$college->id}}">
                                                            {{-- Role Name --}}
                                                        <td>
                                                           {{$college->name}}
                                                        </td>
                                                        {{-- Number of Users --}}
                                                        <td>
                                                           {{$college->users->count()}}
                                                        </td>
                                                        
                                                        {{-- Description --}}
                                                        <td>
                                                           {{ $college->programs->count() }}
                                                        </td>
    
                                                        {{-- Actions --}}
                                                        <td>
                                                            @can('update',$college)
                                                            {{-- View/Update A Role --}}
                                                            <a href="{{route('show_college',['college'=>$college])}}">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            @endcan
    
                                                            @can('delete',$college)
                                                             {{-- Delete A Role --}}
                                                             <a href="#">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            @endcan
    
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