<x-layout>
      
        
        <div class="container-fluid">
                <div class="dashboard-container">
    
                    {{-- Each Whole Table Screen --}}
                    <div class="process-bar">
                        <div class="process-bar">
                            <div class="process-order">
                                <h3 style="text-align:center">ZONES</h3>
                                <span>
                                        {{-- <form >
                                            <input type="text" class="search_box" data-url="" placeholder="search name..." style="text-align:center;">
                                                <i class="fa fa-search"></i>
                                        </form> --}}
                                </span>
                            </div>
    
                            <div id="search_result_for_user_list" class=" row ">
                                {{-- Each Account will sit in this --}}
                                @foreach(App\Models\Zone::all() as $zone)
                    
                                    <div class="col-sm-3 col-md-4 mt-3">
                                        {{-- If User is Ill --}}
                                        <a class="card text-white bg-primary" href="{{route('show_zone',$zone)}}">
                                            <div class="card-body">
                                                <small class="text-uppercase font-weight-bold">Zone: {{$zone->name}}</small><br>
                                                
                                                <small class="text-uppercase font-weight-bold">Members - {{$zone->users()->count()}}</small><br>
                                                
                                                <small class="text-uppercase font-weight-bold">Residences - {{$zone->residences->count()}}</small>

                                            </div>
                                        </a>
                                    </div>
                                @endforeach

                                {{-- Others Zone --}}
                                <div class="col-sm-3 col-md-4 mt-3">
                                    {{-- If User is Ill --}}
                                    <a class="card text-white bg-primary" href="{{route('show_others_zone')}}">
                                        <div class="card-body">
                                            <small class=" text-uppercase font-weight-bold">Zone: Others</small><br>

                                            <small class=" text-uppercase font-weight-bold">Members - {{App\Models\Zone::otherZoneMembers()->count()}} </small><br>

                                            <small class=" text-uppercase font-weight-bold">Residences - {{App\Models\Zone::otherZoneResidences()->count()}} </small>

                                        </div>
                                    </a>
                                </div>


                            </div>
                           
                        </div>
                    </div>
                    {{-- Whole Table Screen Ends --}}
    
                   
    
    
                </div> <!-- end of dashboard container -->
    
        </div>
            <!-- /.conainer-fluid -->
    
    </x-layout>