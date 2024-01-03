<x-layout>
      
        
    <div class="card-body">
        

        {{-- For The Preacher --}}
        <div class="accordion col-12" id="accordiontwoExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <div class="accordion-button  btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                  PREACHER
                </div>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordiontwoExample">
                <div class="accordion-body">

                    <div class="card-body bg-white">


                       @foreach(App\Models\Role::preacher_level()->get() as $ministry)
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
                       @endforeach
                            
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
                  THE MINISTRIES
                </div>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                    <div class="card-body bg-white">


                       @foreach(App\Models\Role::ministries() as $ministry)
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
                       @endforeach
                            
                    </div>

                </div>
              </div>
            </div>
        </div>


    </div>
        <!-- /.conainer-fluid -->

</x-layout>