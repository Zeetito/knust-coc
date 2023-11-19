<x-layout>
      
        
    <div class="container">
            <div class="dashboard-container">

                {{-- New Meeting Button --}}
                <span>
                    <button class="btn modal-button btn-info float-right" data-url="{{route('create_meeting')}}" data-toggle="modal" data-target="#myModal" >
                        Add to List
                    </button>
                </span>

                <div class="process-bar">
                            <h3 style="text-align:center">Meetings</h3>
                            <span>
                                    <form >
                                        <input type="text" class="search_box" data-url="" placeholder="search name..." style="text-align:center;">
                                            <i class="fa fa-search"></i>
                                    </form>
                            </span>


                        {{-- Attendance Table --}}
                        <div class="pre-scrollable" >

                                <div class="card-body">
                                        <table class="table table-striped">
                                            {{-- Table Head --}}
                                            <thead>
                                                <tr>
                                                    <th>Meeting</th>
                                                    <th>Descriptions</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            {{-- Table Body --}}
                                            <tbody class="search_result">
                                                @foreach(App\Models\Meeting::all() as $meeting)

                                                <tr id="tr_{{$meeting->id}}">
                                                        {{-- Meeting Name --}}
                                                    <td>
                                                       {{$meeting->name}}
                                                    </td>
                                     
                                                    
                                                    {{-- Description --}}
                                                    <td>
                                                       {{ $meeting->description != "" ? $meeting->description : "No Description" }}
                                                    </td>

                                                    {{-- Actions --}}
                                                    <td>

                                                        <a href="{{route('show_meeting',$meeting)}}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>

                                                        <a class=" modal-button" data-url="{{route('confirm_meeting_delete',['meeting'=>$meeting])}}" data-toggle="modal" data-target="#myModal" >
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                              

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
                {{-- Whole Table Screen Ends --}}

               


            </div> <!-- end of dashboard container -->

    </div>
        <!-- /.conainer-fluid -->

</x-layout>