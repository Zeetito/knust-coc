<x-layout>
      
        
        <div class="container-fluid">
                <div class="dashboard-container">
    
                    {{-- Each Whole Table Screen --}}
                    <div class="process-bar">
                        <div class="process-bar">
                            <div class="process-order">
                                <h3 style="text-align:center"> Attendance Session: {{$attendance->meeting->name." - ".$attendance->created_at->format('Y-M-d-D')}}</h3>
                                <span>
                                        <form >
                                            <input  type="text" class="search_box"  id="for_user_list" data-url="{{route("search_attendance_users",['attendance'=>$attendance] )}}" placeholder="search name..." style="text-align:center;">
                                                <i class="fa fa-search"></i>
                                        </form>
                                </span>
                            </div>
    
                            {{-- Attendance Table --}}
                            <div class="pre-scrollable" >
    
                                    <div class="card-body">
                                            <table class="table table-striped">
                                                {{-- Table Head --}}
                                                <thead>
                                                    <tr>
                                                        <th>Member</th>
                                                        <th>Zone</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                {{-- Table Body --}}
                                                <tbody id="search_result_for_user_list">
                                                    @foreach($members as $member)
                                                    <tr id="tr_{{$member->id}}">
                                                        <td>{{$member->fullname()}}</td>
                                                        <td>{{$member->biodata !=null ? $member->zone->name : "No Zone" }}</td>
                                                        <td>
                                                            @if($member->is_checked($attendance))

                                                                        @can('check',$member)
                                                                            {{-- Uncheck User button --}}
                                                                            <span type="button" class="check_button" id="{{$member->id}}" data-toggle="modal" data-target="" data-url="{{route('check_user',['attendance'=>$attendance , 'user'=>$member])}}" >
                                                                                <i class="text-warning fa fa-check"></i>
                                                                            </span> 
                                                                         @else
                                                                            {{-- Not A button --}}
                                                                            <span type="button" class="button message"  >
                                                                                <i class="text-success fa fa-check"></i>
                                                                            </span>
                                                                        @endcan

                                                            @else
                                                                        {{-- Check User Button --}}
                                                                        <button class="check_button" id="{{$member->id}}" data-url="{{route('check_user',['attendance'=>$attendance , 'user'=>$member])}}" >
                                                                             <i class=" text-danger fa fa-check"></i>
                                                                        </button>

                                                            @endif

                                                            
                                                        </td>
                                                        {{-- <td>
                                                            <span class="badge badge-success">Active</span>
                                                        </td> --}}
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                {{-- Table Body Ends --}}
                                            </table>
                                           
                                    </div>
                            
                            </div>
                            {{--Users Table Ends--}}
    
                            {{$members->links()}}
                           
                        </div>
                    </div>
                    {{-- Whole Table Screen Ends --}}
    
                </div> <!-- end of dashboard container -->
    
        </div>
            <!-- /.conainer-fluid -->
    
</x-layout>