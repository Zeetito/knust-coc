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
   
                               {{-- Username --}}
                                    <strong>You're here because You either said, you couldn't find your hostel or you live at the house</strong>
                                   <div class="col-12 mb-3 mt-3">
                                        <strong>Name Of Hostel/ Homestel</strong>

                                       <input type="text" value="{{old('name')}}" name="name" autocomplete="off" class="form-control" placeholder="Eg. Adoma Hostel / Adamu and Friends Homestel / My Home" required>
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
                                
                                {{-- Description --}}
                                <div class="col-12 mb-3">
                                    <strong>Description</strong>
                                    <input class="form-control"  placeholder="Eg. Near Ayigya Market" type="text" name="description" id="" required>
                                    
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