<x-layout>

    <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>Create A <h3>Non-Student Member</h3> Profile</strong>

                </div>
                <div class="card-body">
                <form action="{{route('store_profile',['user'=>$user])}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        {{-- UserName --}}
                        <div class="form-group row">
                            {{-- <label class="col-md-3 form-control-label">Hello</label> --}}

                            <div class="col-md-6">
                                <p class="form-control-static">Hello {{$user->username}} Help us know more about you</p>
                            </div>
                        </div>

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


                                        
                                            </p>
                                                
                                        </div>

                                    </div>
                                  </div>
                                </div>
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



                                        Can't Find Your Residence? <input type="radio" class=""  name="residence_id" value="unknown">
                                    </span>
                            </div>

                            {{-- NsStatus --}}
                            <div class="col-md-3 mb-4">
                                <strong>Are you a National Service Personnele ?</strong>
                            <select class="form-control" value="{{old('ns_status')}}" autocomplete="off" name="ns_status" id="ns_status">
                                <option value=" ">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                                    @error('ns_status')
                                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                    @enderror
                            </div>

                            {{-- Room --}}
                            {{-- <label class="col-md-3 mb-4 form-control-label" for="text-input">First Name</label> --}}
                            <div class="col-md-3 mb-4">
                                <strong>Room</strong>
                                <input type="text"  value="{{old('room')}}" name="room" autocomplete="off" class="form-control" placeholder="Room">
                                    {{-- <span class="help-block">Room</span> --}}
                                     {{-- Error Message --}}
                                     @error('room')
                                     <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                     @enderror
                            </div>

                            {{-- is_Alumini --}}
                            <div class="col-md-3 mb-4">
                                
                                <strong>Are you an Alumni of the KNUST CoC ?</strong>
                                <select class="form-control" value="{{old('is_alumni')}}" autocomplete="off" name="is_alumni" id="is_alumini">
                                    <option value=" ">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                    @error('is_alumini')
                                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                    @enderror
                            </div>

                            {{-- Year Group Id --}}

                            <div class="col-md-3 mb-4">
                                    <strong>For Alumni Only</strong>
                                    <select class="form-control" name="year_group_id" id="year_group_id">
                                        <option value="">Select Year Group</option>
                                        @foreach(App\Models\YearGroup::all() as $year_group)
                                            <option value="{{$year_group->id}}"> {{$year_group->name}} </option>
                                        @endforeach
                                    </select>
                                {{-- <span class="help-block">Zone</span> --}}
                                {{-- Error Message --}}
                                    @error('year_group_id')
                                    <p class='m=0 small alert alert-danger shadow-sm'>{{"Please Select A Zone"}}</p>
                                    @enderror
                            </div>


                            {{-- End of Form Group --}}

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
                            {{-- <div class="col-md-3 mb-4">
                                <strong>School Vodafone</strong> --}}
                                <input type="text" class="form-control" value="{{old('school_voda')}}" hidden name="school_voda">
                            {{-- </div> --}}

                            {{-- Other Contact --}}
                            {{-- <div class="col-md-3 mb-4">
                                <strong>Other Contact (Optional)</strong> --}}
                                <input type="text" class="form-control" hidden value="{{old('other_contact')}}" name="other_contact">
                            {{-- </div> --}}

                            {{-- GUARDIAN CONTACTS --}}
                            <h6 class="col-md-12 mb-4">These Contacts Are by Default Only Visible to you and the leadership</h6>
                            
                            <div class="col-md-6 mb-4">
                                <strong>Guardian Contact A</strong>
                                <input type="text" class="form-control" value="{{old('guardian_a')}}" name="guardian_a" placeholder="Contact Here" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <strong>Relation with Guardian A</strong>
                                <input type="text" class="form-control" value="{{old('relation_a')}}" name="relation_a" placeholder="Eg. Father, Mother, etc" required>
                            </div>

                            {{-- <div class="col-md-6 mb-4">
                                <strong>Guardian Contact B (Optional) </strong> --}}
                                <input type="text" class="form-control" value="{{old('guardian_b')}}" hidden name="guardian_b" placeholder="Contact Here" >
                            {{-- </div> --}}
                            {{-- <div class="col-md-6 mb-4">
                                <strong>Relation with Guardian B (Optional)</strong> --}}
                                <input type="text" hidden class="form-control" value="{{old('relation_b')}}" name="relation_b" placeholder="Eg. Father, Mother, etc">
                            {{-- </div> --}}

                        </div>


                    <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>

                    </form>
                </div>
                <div class="card-footer">
                    {{-- <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button> --}}
                </div>
            </div>


        </div>

</x-layout>
