<x-layout>
      
        
        <div class="container-fluid">
                <div class="dashboard-container">
    
                    {{-- Each Whole Table Screen --}}
                    <div class="process-bar">
                        <div class="process-bar">
                            <div class="process-order">
                                <h3 style="text-align:center">Attendance Sessions</h3>
                            </div>
    
                            {{-- Attendance Table --}}
                            <div class="pre-scrollable" >
    
                                    <div class="card-body">
                                            <table class="table table-striped">
                                                {{-- Table Head --}}
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Date</th>
                                                        <th>Venue</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                {{-- Table Body --}}
                                                <tbody>
                                                   @foreach($attendances as $attendance)

                                                    <tr>
                                                        <td>
                                                           {{$attendance->meeting->name}}
                                                        </td>
                                                        <td>{{$attendance->created_at->format('Y-M-d-D')}}</td>
                                                        <td> {{$attendance->venue}}</td>
                                                        <td> {{$attendance->is_active == 0 ? "Ended":"In Session"}}</td>
                                                        <td>
                                                             <a href="{{route('show_attendance',$attendance->id)}}">
                                                                <i class="fa fa-eye"></i>
                                                            </a>

                                                             <a href="#">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                                  <label class="switch switch-text switch-info-outline-alt">
                                                                        <input type="checkbox" class="switch-input">
                                                                        <span class="switch-label" data-on="On" data-off="Off"></span>
                                                                        <span class="switch-handle"></span>
                                                                    </label>
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
    
                            {{$attendances->links()}}
                           
                        </div>
                    </div>
                    {{-- Whole Table Screen Ends --}}
    
                    {{-- Create new Attendance Session Div --}}

                    {{-- @can('create,attendance') --}}
                        <div class="card border-danger">

                        <form action="{{route('create_attendance')}}" method="post">
                                @csrf

                                <div class="card-header">
                                    Create New Attendance Session
                                </div>


                                <div class="card-body">
                                       
                                        {{-- Type --}}
                                        <div class="form-group">
                                                <label for="venue">Type Of Gathering</label>
                                                <select id="select" name="meeting_type" class="form-control">
                                                    <option value=" ">Please select</option>

                                                    @foreach($meetings as $meeting)
                                                <option value="{{$meeting->id}}">{{$meeting->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            @error('meeting_type')
                                            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                            @enderror
                                         {{-- Venue --}}
                                           <div class="form-group">
                                                <label for="venue">Venue</label>
                                           <input type="text" name="venue" class="form-control" value="{{old('venue','Unity Hall Basement')}}" id="venue" placeholder="What's this Session for ? eg: Sunday Service">
                                            </div>
                                            @error('venue')
                                            <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                            @enderror
                                </div>

                              
                                    

                                <div class="card-footer">
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Create</button>
                                </div>

                            </form>

                        </div>
                    {{-- @endcan --}}
    
                </div> <!-- end of dashboard container -->
    
            </div>
            <!-- /.conainer-fluid -->
    
</x-layout>