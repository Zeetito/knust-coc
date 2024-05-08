<x-layout>

    <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>Create A Profile as A Student</strong>

                </div>
                <div class="card-body">
                <form action="{{route('store_profile',['user'=>$user])}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        {{-- UserName --}}
                        <div class="form-group row">


                            
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
                                                <strong>1.Selecting Your Residence</strong>
                                                <ul>
                                                    <li>Search The Name of Your Residence(Hostel or Homestel)</li>

                                                    <li>Select Your choice from the list that appear (Probably at the bottom of your screen)</li>
                                                </ul>

                                                <strong>Can't Find Your Hostel Or Homestel ?  You Come From Home Daily ?</strong>
                                                <ul>
                                                    <li>Clear the Search box and Choose "Can't Find Hostel/Homestel"</li>

                                                    <li>Continue with the Rest of the Details you would complete with your residence on another page. </li>
                                                </ul>

                                                <strong>2.Selecting Your Program Of Study</strong>
                                                <ul>
                                                    <li>Search The Name of Your Program</li>

                                                    <li>Select Your choice from the list that appear (Probably at the bottom of your screen)</li>

                                                    <li>The Value(Name) will be converted to A number. You're good to proceed</li>
                                                </ul>

                                                <strong>Can't Find Your Program Of Study ? (For Students)</strong>
                                                <ul>
                                                    <li>Clear the Search box and Choose "Can't Find Program"</li>

                                                    <li>Continue with the Rest of the Details you would complete with your Program on another page. </li>
                                                </ul>
                                            </p>
                                                
                                        </div>

                                    </div>
                                  </div>
                                </div>
                            </div>


                            {{-- <label class="col-md-3 form-control-label">Hello</label> --}}
                            <div class="col-md-6">
                                <p class="form-control-static">Hello {{$user->username}} Help us know more about you</p>
                            </div>
                        </div>

                        <div class="form-group row">


                          {{-- Program List for Each College --}}
                            {{-- Program Id --}}
                            <div class="col-md-3 mb-4 card ">
                                <span class="fa fa-hand-pointer-o accordion accordion-item accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree" id="accordionExampleThree" style="font-size: 22px; font-weight:bold " >Tap Choose Program Of Study</span>
                                    <div class="accordion-body accordion-collapse collapse" id="collapseThree" data-bs-parent="#accordionExampleThree">

                                        <table   class="table  datatable table-striped " >
                                            {{-- Table Head --}}
                                            
                                            <thead>
                                                <tr>
                                                    <th>Program</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            {{-- Table Body --}}
                                            <tbody class="search_result">
                                                @foreach(App\Models\Program::all() as $program)
                                                
                                                <tr id="tr_{{$program->id}}">
                                                    {{-- user Name --}}
                                                    <td>
                                                        {{$program->name}}
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="radio"  name="program_id" value="{{$program->name}}">
                                                    </td>
                                                    {{-- Number of Users --}}
                                                </tr>
                                                @endforeach

                                              
                                            </tbody>
                                            {{-- Table Body Ends --}}
                                        </table>
                                    </div>
                                    <br>
                                    <span class="" style="font-family:Verdana, Geneva, Tahoma, sans-serif">

                                        Can't Find Your Program? <input type="radio" class=""  name="program_id" value="unknown">
                                    </span>
                            </div>

                            {{-- Year --}}
                            <div class="col-md-3 mb-4">
                            <strong>Which Year Are You ?</strong>
                            <select class="form-control" value="{{old('year')}}" name="year" id="years">
                                <option value=" ">SELECT YEAR</option>

                                @for($i=1; $i<=8; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor

                            </select>
                                    @error('year')
                                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                    @enderror
                            </div>

                            {{-- Residence List for Each Zone --}}
                            {{-- Residence Id --}}
                            <div class="col-md-3 mb-4 card ">
                                <span class="fa fa-hand-pointer-o accordion accordion-item accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" id="accordionExampleTwo" style="font-size: 22px; font-weight:bold " >Tap Choose Residence</span>
                                    <div class="accordion-body accordion-collapse collapse" id="collapseTwo" data-bs-parent="#accordionExampleTwo">

                                        <table   class="table  datatable table-striped " >
                                            {{-- Table Head --}}
                                            
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th data-searchable="false">Zone</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            {{-- Table Body --}}
                                            <tbody class="search_result">
                                                @foreach(App\Models\Residence::all() as $residence)
                                                
                                                <tr id="tr_{{$residence->id}}">
                                                    {{-- user Name --}}
                                                    <td>
                                                        {{$residence->name}}
                                                    </td>
                                                    <td>
                                                        {{$residence->zone->name}}
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="radio"  name="residence_id" value="{{$residence->name}}">
                                                    </td>
                                                    {{-- Number of Users --}}
                                                </tr>
                                                @endforeach

                                                {{-- <input type="radio"  name="residence_id" value="{{$user->residence()->name}}" checked hidden> --}}

                                              
                                            </tbody>
                                            {{-- Table Body Ends --}}
                                        </table>
                                    </div>
                                    <br>
                                    <span class="" style="font-family:Verdana, Geneva, Tahoma, sans-serif">



                                        <strong>
                                            Can't Find hostel or homestel?
                                            <input type="radio" class=""  name="residence_id" value="unknown">
                                        </strong>
                                        
                                    </span>
                            </div>

                               {{-- Room --}}
                            {{-- <label class="col-md-3 mb-4 form-control-label" for="text-input">First Name</label> --}}
                            <div class="col-md-3 mb-4">
                                <strong>Room Number</strong>
                                <input type="text"  value="{{old('room')}}" name="room" class="form-control" placeholder="Room">
                                    {{-- <span class="help-block">Room</span> --}}
                                     {{-- Error Message --}}
                                     @error('room')
                                     <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                     @enderror
                            </div>

                            {{-- <div>Contacts</div> --}}

                            {{-- <div> --}}
                                {{-- Contacts --}}

                                {{-- Main Phone --}}
                                <div class="col-md-3 mb-4">
                                    <strong>Main Phone Contact</strong>
                                    <input type="text" class="form-control" value="{{old('phone')}}" name="phone" required>
                                </div>
                                
                                {{-- WhatsApp Contact --}}
                                <div class="col-md-3 mb-4">
                                    <strong>WhatsApp Contact</strong>
                                    <input type="text" class="form-control" value="{{old('whatsapp')}}" name="whatsapp" required>
                                </div>

                                {{-- School Voda --}}
                                <div class="col-md-3 mb-4">
                                    <strong>School Vodafone</strong>
                                    <input type="text" class="form-control" value="{{old('school_voda')}}" name="school_voda">
                                </div>

                                {{-- Other Contact --}}
                                {{-- <div class="col-md-3 mb-4">
                                    <strong>Other Contact (Optional)</strong> --}}
                                    <input type="text" class="form-control" value="{{old('other_contact')}}" hidden name="other_contact">
                                {{-- </div> --}}

                                {{-- GUARDIAN CONTACTS --}}
                                <h6 class="col-md-12 mb-4">These Contacts Are by Default Only Visible to you and the leadership</h6>

                                {{-- Required for user --}}
                                
                                @if($user->is(auth()->user()))
                                    <div class="col-md-6 mb-4">
                                        <strong>Guardian Contact A</strong>
                                        <input type="text" class="form-control" value="{{old('guardian_a')}}" name="guardian_a" placeholder="Contact Here" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <strong>Relation with Guardian A</strong>
                                        <input type="text" class="form-control" value="{{old('relation_a')}}" name="relation_a" placeholder="Eg. Father, Mother, etc" required>
                                    </div>
                                @else
                                    <div class="col-md-6 mb-4">
                                        <strong>Guardian Contact A</strong>
                                        <input type="text" class="form-control" value="{{old('guardian_a')}}" name="guardian_a" placeholder="Contact Here">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <strong>Relation with Guardian A</strong>
                                        <input type="text" class="form-control" value="{{old('relation_a')}}" name="relation_a" placeholder="Eg. Father, Mother, etc">
                                    </div>
                                @endif

                          
                            {{-- <div class="col-md-6 mb-4"> --}}
                                    {{-- <strong>Guardian Contact B (Optional) </strong> --}}
                                    <input type="text" class="form-control" value="{{old('guardian_b')}}" name="guardian_b" hidden placeholder="Contact Here" >
                                {{-- </div> --}}
                                {{-- <div class="col-md-6 mb-4"> --}}
                                    {{-- <strong>Relation with Guardian B (Optional)</strong> --}}
                                    <input type="text" class="form-control" value="{{old('relation_b')}}" name="relation_b" hidden placeholder="Eg. Father, Mother, etc">
                                {{-- </div> --}}
                            {{-- </div> --}}
                            
                        </div>




                        {{-- Upload Profile Pic Option --}}
                        {{-- <div class="form-group row"> --}}
                            {{-- <label class="col-md-3 mb-4 form-control-label" for="file-input">File input</label> --}}
                            {{-- <div class="col-md-9"> --}}
                                {{-- Upload a profile picture --}}

                            {{-- </div> --}}
                        {{-- </div> --}}
                    <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>

                    </form>
                </div>
                <div class="card-footer">
                    {{-- <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button> --}}
                </div>
            </div>


        </div>

</x-layout>
