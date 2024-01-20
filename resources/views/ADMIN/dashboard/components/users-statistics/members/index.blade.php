<x-layout>
      
        
    <div class="card-body">
        

        {{-- For The Preacher --}}
        <div class="accordion col-12" id="accordiontwoExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <div class="accordion-button  btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                  TOTAL STATISTICS - MEMBERS
                </div>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordiontwoExample">
                <div class="accordion-body">

                    <div class="card-body bg-white">


                       {{-- @foreach(App\Models\Role::preacher_level()->get() as $ministry) --}}
                          @if(App\Models\User::members()->count() > 0 )

                              <div class="row">
                                <span class="h6 col-12 font-weight-bold text-uppercase">Total -{{ App\Models\User::members()->count() }}</span>

                                {{-- @foreach($ministry->users as $user) --}}

                                  <span class="card text-white bg-info mr-1 col-sm-4 col-md-5 mt-3"  >
                                    <div class="card-body">
                                        <div class="h5   mb-1">
                                           Gender
                                        </div>
                                        <small class="text-uppercase font-weight-bold">Gents: {{App\Models\User::members()->where('gender','m')->count()}}</small> <br>
                                        <small class="text-uppercase font-weight-bold">Ladies: {{App\Models\User::members()->where('gender','m')->count()}}</small> <br>
                                        <br>
                                        <div class="h5   mb-1">
                                           Batismal Status
                                        </div>
                                        <small class="text-uppercase font-weight-bold">Baptised: {{App\Models\User::members()->where('is_baptized','1')->count()}}</small> <br>
                                        <small class="text-uppercase font-weight-bold">UnBaptised: {{App\Models\User::members()->where('is_baptized','0')->count()}}</small> <br>
                                        {{-- <small class="text-uppercase font-weight-bold">WhatsApp: {{$user->phone ? $user->phone->body : "None"}}</small> <br> --}}

                                    </div>
                                  </span>
                                {{-- @endforeach --}}

                              </div>
                        @endif
                       {{-- @endforeach --}}
                            
                    </div>

                </div>
              </div>
            </div>
        </div>

        {{-- For The Ministries --}}
        <div class="accordion col-12" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <div class="accordion-button  btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  YEAR GROUPS
                </div>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <div class="card-body bg-info">


                        @for ($i = 1; $i < 9; $i++)
                           
                            @if(App\Models\User::year_members_exist($i) == true)

                            <div class="h5   mb-1">
                                Year {{$i}} ({{App\Models\User::year_members($i)->count()}})
                             </div>
                             <small class="text-uppercase font-weight-bold">Gents: {{App\Models\User::year_members($i)->where('gender','m')->count()}}</small> <br>
                             <small class="text-uppercase font-weight-bold">Ladies: {{App\Models\User::year_members($i)->where('gender','f')->count()}}</small> <br>
                             <br>

                            @endif

                        @endfor
                       {{-- @foreach(App\Models\Role::ministries() as $ministry)
                          @if($ministry->users->count() >0 )

                              <div class="row">
                                <span class="h6 col-12 font-weight-bold text-uppercase">{{$ministry->name}}</span>

                                @foreach($ministry->users as $user)

                                  <span class="card text-white bg-info mr-1 col-sm-4 col-md-5 mt-3"  >
                                    <div class="card-body">
                                        <div class="h1  text-right mb-4">
                                            <i>
                                              <a href="{{route('view_profile', $user)}}">
                                                  <img src="{{$user->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                              </a>
                                            </i>
                                        </div>
                                        <small class="text-uppercase font-weight-bold">Name: {{$user->fullname()}}</small> <br>
                                        <small class="text-uppercase font-weight-bold">Phone: {{$user->phone ? $user->phone->body : "None"}}</small> <br>
                                        <small class="text-uppercase font-weight-bold">WhatsApp: {{$user->phone ? $user->phone->body : "None"}}</small> <br>

                                    </div>
                                  </span>
                                @endforeach

                              </div>
                        @endif
                       @endforeach --}}
                            
                    </div>

                </div>
              </div>
            </div>
        </div>


    </div>
        <!-- /.conainer-fluid -->

</x-layout>