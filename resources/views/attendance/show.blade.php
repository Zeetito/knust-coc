<x-layout>
      
        
        <div class="container-fluid">
                <div class="dashboard-container">
    
                    {{-- Each Whole Table Screen --}}
                    <div class="process-bar">
                        <div class="process-bar">
                            <div class="process-order">
                                <h3 style="text-align:center"> Attendance Session: {{$attendance->meeting->name." - ".$attendance->created_at->format('Y-M-d-D')}}</h3>
                            </div>
    
                            {{-- Attendance Table --}}
                            <div class="pre-scrollable" >
    
                                    <div class="card-body">
                                            <table class="table table-striped">
                                                {{-- Table Head --}}
                                                <thead>
                                                    <tr>
                                                        <th>Member</th>
                                                        <th>MarkedBy</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                {{-- Table Body --}}
                                                <tbody>
                                                   @foreach($members as $member)
                                                   {{-- {{$user_who_marked = $attendance->user_marked_by($member->pivot->checked_by)}} --}}
                                                    <tr>
                                                        <td>{{$member->firstname." ".$member->lastname}}</td>
                                                        <td> {{ $attendance->user_marked_by($member->pivot->checked_by)->firstname." ".$attendance->user_marked_by($member->pivot->checked_by)->lastname }} </td>
                                                        <td>
                                                             <a href="#">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
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