<x-layout>
      
        
        <div class="container-fluid">
                <div class="dashboard-container">
    
                    {{-- Each Whole Table Screen --}}
                    <div class="process-bar">
                        <div class="process-bar">
                            <div class="process-order">
                                <h3 style="text-align:center">Zones</h3>
                                <span>
                                        {{-- <form >
                                            <input type="text" class="search_box" data-url="" placeholder="search name..." style="text-align:center;">
                                                <i class="fa fa-search"></i>
                                        </form> --}}
                                </span>
                            </div>
    
                            {{-- Attendance Table --}}
                            <div class="pre-scrollable" >
    
                                    <div class="card-body">
                                            <table class="table table-striped">
                                                {{-- Table Head --}}
                                                <thead>
                                                    <tr>
                                                        <th>Zone Name</th>
                                                        <th>People</th>
                                                        <th>Hostels</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                {{-- Table Body --}}
                                                <tbody class="search_result">
                                                    @foreach(App\Models\Zone::all() as $zone)
    
                                                    <tr id="tr_{{$zone->id}}">
                                                            {{-- Role Name --}}
                                                        <td>
                                                           {{$zone->name}}
                                                        </td>
                                                        {{-- Number of Users --}}
                                                        <td>
                                                           {{$zone->users()->count()}}
                                                        </td>
                                                        
                                                        {{-- Description --}}
                                                        <td>
                                                           {{ $zone->residences->count() }}
                                                        </td>
    
                                                        {{-- Actions --}}
                                                        <td>
                                                            {{-- View/Update A Role --}}
                                                            <a href="{{route('show_zone',$zone)}}">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
    
                                                            @can('update',$zone)
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