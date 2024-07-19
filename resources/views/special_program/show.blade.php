<x-guest_layout>
        
    <div class="card">
            <div class="">

                <div class="card-header">
                    {{$special_program->name}}
                </div>

                <div class="card-body">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                            {{-- <a class="navbar-brand" href="#">Navbar</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button> --}}
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">

                                    {{-- ProgramName --}}
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">{{$special_program->name}}</a>
                                    </li>
                                    
                                    {{-- Participants --}}
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="#">Participants</a>
                                    </li>
                                    
                                    {{-- Recidents --}}
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="#">Residences</a>
                                    </li>
                                   
                                </ul>
                            </div>

                          
                    </nav>
                
                    <div class="row m-1">
                        {{-- Participants --}}
                        <div class="rounded border border-solid border-secondary p-3 col-12">
                            <a href="{{route('create_special_program_participant',['special_program'=>$special_program->id])}}">
                                <div class="float-end fa fa-user-plus btn border border-solid"  >

                                </div>
                            </a>

                            <h5 class="text-center card-title">Participants Details</h5>

                            <p>Number of Participants: {{$special_program->participants->count()}}</p>
                            <p>Number of Males: {{$special_program->male_participants()->count()}}</p>
                            <p>Number of Females: {{$special_program->female_participants()->count()}}</p>
    
                        </div>

                        {{-- Residences --}}
                        <div class="rounded border border-solid border-secondary p-3 col-12 ml-1 overflow-auto">
                            <div class="float-end fa fa-plus-square btn border border-solid" data-url="{{route('create_special_program_residence',$special_program->id)}}" data-target="#myModal" data-toggle="modal"></div>
                            <div class="h5 text-center card-title">Residences Details</div>

                            @if($special_program->residences)
                                @foreach($special_program->residences as $residence)
                                <div class="border border-solid rounded border-2 border-secondary mb-2 p-2">
                                    <div><a href="{{route('show_special_program_residence',$residence->id)}}" class="fa fa-eye">{{" ".$residence->name}}</a></div>

                                    <p>Number of Rooms: {{$residence->rooms->count()}}</p>
                                    <p>Number of Participants: {{$residence->participants->count()}}</p>
                                    <p>Number of Male Participants: {{$residence->male_participants()->count()}}</p>
                                    <p>Number of Female Participants: {{$residence->female_participants()->count()}}</p>
                                </div>
                                @endforeach
                            @else
                                <p>No Residences</p>
                            @endif
    
                        </div>
                    </div>

                </div>


            </div>



            </div> <!-- end of dashboard container -->

        </div>
        <!-- /.conainer-fluid -->

</x-guest_layout>