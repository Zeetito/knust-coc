<x-layout>
 
    <body class="app flex-row align-items-center">
        <div class="container">
   
           {{-- Form Begins --}}
                <form action="{{route('store_user_program',['user'=>$user])}}" method="Post">
                    @method('post')
                   @csrf
                   <div class="row justify-content-center" >
                       <div class="col-md-6">
                           <div class="card mx-4" style="border-radius:25px;">
                               <div class="card-body p-4 row">
   
                               {{-- Username --}}
                                    <strong>Can't Find Program of Study?</strong>

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
                                                        <strong>1.Choosing Your Program Of Study</strong>
                                                        <ul>
                                                            <li>Confirm Once again from the second form on the bottom of this page if you cannot find your program of study.</li>
        
                                                            <li>If so, Come back to the First Form, input the name of your program and select the college</li>
                                                        </ul>
        
                                                    </p>
                                                        
                                                </div>
        
                                            </div>
                                          </div>
                                        </div>
                                    </div>
        


                                   <div class="col-12 mb-3 mt-3">
                                        <strong>Name Of Program of Study</strong>

                                       <input type="text" value="{{old('name')}}" name="name" autocomplete="off" class="form-control" placeholder="Eg. Bsc.Computer Science" required>
                                   </div>
                                   @error('name')
                                   <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                   @enderror
   
                               {{-- Category --}}
                                   <div class="col-12 mb-3">
                                    <strong>Category</strong>
                                    <select class="form-control" name="category" id="" required>
                                        <option value="">Select</option>
                                        <option value="ug">UnderGraduate Program</option>
                                        <option value="pg">PostGraduate Program</option>
                                    </select>
                                   </div>
                                   @error('category')
                                   <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                   @enderror

                                {{-- College --}}
                                <div class="col-12 mb-3">
                                    <strong>College</strong>
                                    <select class="form-control" name="college_id" id="search_result_for_college_list" required>
                                            <option value="">Select</option>
                                        @foreach(App\Models\College::all() as $college)
                                            <option value="{{$college->id}}">{{$college->name}}</option>
                                        @endforeach


                                    </select>

                                </div>
                                
                                {{-- Span --}}
                                <div class="col-12 mb-3">
                                    <strong>What's the Span of the Program (How many years in all) ?</strong>
                                    <input class="form-control"   type="Number" min="1" name="span" id="" required>
                                    
                                   </div>
                                   @error('span')
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
                <form action="{{route('update_biodata_program',['user'=>$user])}}" method="Post">
                    @method('put')
                   @csrf
                   <div class="row justify-content-center" >
                       <div class="col-md-6">
                           <div class="card mx-4" style="border-radius:25px;">
                               <div class="card-body p-4 row">
                                <strong>You could also confirm the existence of your Program one more time</strong>
                                    {{-- Residence Id --}}
                                    <div class="col-12 mb-3">
                                        <h6>Residence</h6>
                                        <input list="search_result_for_residence_list" autocomplete="off" id="for_residence_list" value="{{old('program_id')}}"  data-url="{{route('profile_search_programs')}}" class="search_box form-control" name="program_id" id="program" placeholder="Program search..." >
                                        <datalist id="search_result_for_residence_list">

                                            @foreach(App\Models\Program::all() as $program)
                                                <option value="{{$program->name}}">{{$program->college->name}}</option>
                                            @endforeach


                                        </datalist>

                                        
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