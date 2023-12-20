<x-layout>
 
    <body class="app flex-row align-items-center">
        <div class="container">
   
           {{-- Form Begins --}}
                <form action="{{route('store_user_residence',['user'=>$user])}}" method="Post">
                    @method('post')
                   @csrf
                   <div class="row justify-content-center" >
                       <div class="col-md-6">
                           <div class="card mx-4" style="border-radius:25px;">
                               <div class="card-body p-4 row">

                                <div class="accordion col-12" id="accordionExample">
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="headingOne">
                                        <div class="accordion-button  btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                          Read Me...
                                        </div>
                                      </h2>
                                      <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
    
                                            <div class="card">
    
                                                <strong>INSTRUCTIONS FOR ALL</strong>
                                                <p>
                                                    <strong>1.If You're In A Hostel Or Homestel</strong>
                                                    <ul>
                                                        <li>Confrim Again the existence of your hostel or homestel's name from the Second form at the bottom of this page.</li>

                                                        <li>Still can't find? Type in the Name of Your Hostel or Homestel.</li>
                                                        
                                                        <li>If You're In A homestel with No Name, Just Say "Homestel". If it has a name, <strong>please</strong> provide it</li>

                                                        <li>Select The Zone inwhich your Homestel is found if you know. If you don't, select "Not Sure"</li>
                                                        
                                                        <li>In The Description Section, type in any landmark</li>

                                                    </ul>

                                                    <strong>2.If You Come From Home</strong>
                                                    <ul>
                                                        <li>I doubt your home has a name does it? If it does, please input the name.</li>

                                                        <li>You Can Simply input "My Home" or "Desmond Atchu's Home" (Using Your own name)</li>
                                                        
                                                        <li>If it is within the boundaries of any zone, input the name of the zone in the description or simply put there any landmark</li>
                                                      
                                                    </ul>
    
                                                </p>
                                                    
                                            </div>
    
                                        </div>
                                      </div>
                                    </div>
                                </div>
   
                               {{-- Username --}}
                                    <strong>Welcome to the "Can't Find My Hostel && I come from Home Community".Carefully read the instructions</strong>
                                   <div class="col-12 mb-3 mt-3">
                                        <strong>Name Of Hostel/ Homestel</strong>

                                       <input type="text" value="{{old('name')}}" name="name" autocomplete="off" class="form-control" placeholder="Eg.My Home/ Adoma Hostel / Adamu and Friends Homestel " required>
                                   </div>
                                   @error('name')
                                   <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                   @enderror
   
                               {{-- Category --}}
                                   <div class="col-12 mb-3">
                                    <strong>Category</strong>
                                    <select class="form-control" name="category" id="" required>
                                        <option value="">Select</option>
                                        <option value="hostel">Hostel</option>
                                        <option value="homestel">Homestel</option>
                                        <option value="home">My Home</option>
                                    </select>
                                   </div>
                                   @error('category')
                                   <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                   @enderror

                                {{-- Zone --}}
                                <div class="col-12 mb-3">
                                    <strong>Zone</strong>
                                    <select class="form-control" name="zone_id" id="" required>
                                        <option value="">Select</option>
                                        <option class="bg-info" value="none">Not Sure</option>
                                        @foreach(App\Models\Zone::all() as $zone)
                                        <option value="{{$zone->id}}">{{$zone->name}}</option>
                                        @endforeach
                                        <option class="bg-info" value="none">OTHERS</option>
                                    </select>
                                   </div>
                                   @error('category')
                                   <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                   @enderror
                                
                                {{-- Description --}}
                                <div class="col-12 mb-3">
                                    <strong>Description</strong>
                                    <input class="form-control"  placeholder="Eg. In Shalom Zone / Near Evandy Hostel" type="text" name="description" id="" required>
                                    
                                   </div>
                                   @error('description')
                                   <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                   @enderror
   
                                           {{-- Register Button --}}
                                   <button type="submit" name="submit" class="btn btn-block btn-success">Save</button>
                               </div>
       
                           </div>
                       </div>
                   </div>
               </form>

               {{-- Confirm Hostel --}}
                <form action="{{route('update_biodata_residence',['user'=>$user])}}" method="Post">
                    @method('put')
                   @csrf
                   <div class="row justify-content-center" >
                       <div class="col-md-6">
                           <div class="card mx-4" style="border-radius:25px;">
                               <div class="card-body p-4 row">
                                <strong>You could also confirm the existence of your hostel one more time</strong>
                                    {{-- Residence Id --}}
                                    <div class="col-12 mb-3">
                                        <h6>Residence</h6>
                                        <input list="search_result_for_residence_list" autocomplete="off" id="for_residence_list" value="{{old('residence_id')}}"  data-url="{{route('profile_search_residences')}}" class="search_box form-control" name="residence_id" id="residence" placeholder="Residence search..." >
                                        <datalist id="search_result_for_residence_list">

                                            @foreach(App\Models\Residence::all() as $residence)
                                                <option value="{{$residence->name}}">{{$residence->zone->name}}</option>
                                            @endforeach


                                        </datalist>

                                        
                                    </div>

                                    <div class="col-12 mb-3">
                                        <strong>Room</strong>
                                        <input type="text" class="form-control" name="room" required>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-block btn-success">Save</button>
                                </div>

                           </div>
                       </div>
                   </div>
               </form>


            {{-- Form Ends --}}
        </div>
    
       </x-layout>