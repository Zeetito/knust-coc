<x-layout>

    <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>User Profile</strong>
                    
                </div>
                <div class="card-body">
                <form action="{{route('update_profile',['user'=>$user])}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        @method('put')
                        {{-- UserName --}}
                        <div class="form-group row">
                            {{-- <label class="col-md-3 form-control-label">Hello</label> --}}
                            <div class="col-md-6">
                                <p class="form-control-static">Hello {{$user->username}} Help us know more about you</p>
                            </div>
                        </div>

                        <div class="form-group row">
                           

                             {{-- Other Name --}}
                            {{-- <label class="col-md-3 form-control-label" for="text-input">First Name</label> --}}
                            {{-- <div class="col-md-3 mb-4">
                                <input type="text"  value="{{old('othername')}}" name="othername" class="form-control" placeholder="Other Name">
                                    {{-- <span class="help-block">Other Name</span> --}}
                                     {{-- Error Message --}}
                                     {{-- @error('othername') --}}
                                     {{-- <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p> --}}
                                     {{-- @enderror --}}
                            {{-- </div> --}}

                          {{-- Program List for Each College --}}


                            {{-- Residence List for Each Zone --}}
                            {{-- Residence Id --}}
                            <div class="col-md-3 mb-4">
                                <h6>Residence</h6>
                                <input list="search_result_for_residence_list" autocomplete="off" id="for_residence_list" value="{{old('residence_id',$user->residence() ? $user->residence()->name : "None")}}"  data-url="{{route('profile_search_residences')}}" class=" search_box form-control" name="residence_id" id="residence" placeholder="Residence search..." >
                                <datalist id="search_result_for_residence_list">
                                    @if(empty($residences))
                                        <option>Search residence...</option>
                                    @else
                                
                                    @foreach($residences as $residence)
                                        <option value="{{$residence->name}}">{{$residence->zone->name}}</option>
                                    @endforeach

                                    @endif
                                    </datalist>
                                {{-- <span class="help-block">Residence</span> --}}

                            </div>

                            {{-- NsStatus --}}
                            <div class="col-md-3 mb-4">
                                <h6>Ns status</h6>
                                <select class="form-control" value="{{old('ns_status',$user->biodata->ns_status)}}" autocomplete="off" name="ns_status" id="ns_status">
                                    <option value="{{$user->biodata->ns_status}}">{{$user->biodata->ns_status ? "Yes":"No"}}</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                @error('ns_status')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror
                            </div>

                            {{-- Room --}}
                            <div class="col-md-3 mb-4">
                                <h6>Room Number</h6>
                                <input type="text"  value="{{old('room',$user->biodata->room)}}" name="room" class="form-control" placeholder="Room">
                                    {{-- <span class="help-block">Room</span> --}}
                                     {{-- Error Message --}}
                                     @error('room')
                                     <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                     @enderror
                            </div>

                            <div class="col-md-3 mb-4">
                                    <h6>Are you an Alumini of the KNUST CoC ?</h6>
                                <select class="form-control" value="{{old('is_alumni',$user->biodata->is_alumni)}}" autocomplete="off" name="is_alumni" id="is_alumni">
                                    <option value="{{$user->biodata->is_alumni}}">{{$user->biodata->is_alumni ? "Yes":"No"}}</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                    @error('is_alumni')
                                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                    @enderror
                            </div>

                             {{-- Year Group Id --}}
                            <div class="col-md-3 mb-4">
                                <h6>Year Group</h6>
                                <strong>For Alumini Only</strong>
                                <select class="form-control"  value="{{old('year_group_id',$user->biodata->year_group_id)}}" name="year_group_id" id="year_group_id">
                                    <option value="{{$user->biodata->year_group_id}}">{{App\Models\YearGroup::find($user->biodata->year_group_id)->name}}</option>
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

                            
                                {{-- Phone --}}
                                <div class="col-md-3 mb-4">
                                    <strong>Main Phone Contact</strong>
                                    <input type="text" class="form-control" value="{{old('phone',$user->phone == null ? "" : $user->phone->body )}}" autocomplete="off" name="phone" required>
                                </div>
                                
                                {{-- WhatsApp Contact --}}
                                <div class="col-md-3 mb-4">
                                    <strong>WhatsApp Contact</strong>
                                    <input type="text" class="form-control" value="{{old('whatsapp',$user->whatsapp == null ? "" : $user->whatsapp->body )}}" autocomplete="off" name="whatsapp" required>
                                </div>
    
                                {{-- School Voda --}}
                                <div class="col-md-3 mb-4">
                                    <strong>School Vodafone</strong>
                                    <input type="text" class="form-control" value="{{old('school_voda',$user->school_voda == null ? "" : $user->school_voda->body )}}" autocomplete="off" name="school_voda">
                                </div>
    
                                {{-- Other Contact --}}
                                <div class="col-md-3 mb-4">
                                    <strong>Other Contact (Optional)</strong>
                                    <input type="text" class="form-control" value="{{old('other_contact',$user->other_contact == null ? "" : $user->other_contact->body )}}" autocomplete="off" name="other_contact">
                                </div>
    
                                {{-- GUARDIAN CONTACTS --}}
                                <h6 class="col-md-12 mb-4">These Contacts Are by Default Only Visible to you and the leadership</h6>
                                
                                <div class="col-md-6 mb-4">
                                    <strong>Guardian Contact A</strong>
                                    <input type="text" class="form-control" value="{{old('guardian_a',$user->main_guardian_contact == null ? "" : $user->main_guardian_contact->body )}}" autocomplete="off" name="guardian_a" placeholder="Contact Here" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <strong>Relation with Guardian A</strong>
                                    <input type="text" class="form-control" value="{{old('relation_a',$user->main_guardian_contact == null ? "" : $user->main_guardian_contact->relation )}}" autocomplete="off" name="relation_a" placeholder="Eg. Father, Mother, etc">
                                </div>
    
                                <div class="col-md-6 mb-4">
                                    <strong>Guardian Contact B (Optional) </strong>
                                    <input type="text" class="form-control" value="{{old('guardian_b',$user->other_guardian_contact == null ? "" : $user->other_guardian_contact->body )}}" autocomplete="off" name="guardian_b" placeholder="Contact Here" >
                                </div>
                                <div class="col-md-6 mb-4">
                                    <strong>Relation with Guardian B (Optional)</strong>
                                    <input type="text" class="form-control" value="{{old('relation_b',$user->other_guardian_contact == null ? "" : $user->other_guardian_contact->relation )}}" autocomplete="off" name="relation_b" placeholder="Eg. Father, Mother, etc">
                                </div>

                       
                    </div>
                       
                        

                       {{-- Upload Profile Pic Option --}}
                        <div class="form-group row">
                            {{-- <label class="col-md-3 mb-4 form-control-label" for="file-input">File input</label> --}}
                            <a href="{{route('edit_avatar_form',$user->id )}} ">
                                <div class="btn col-md-9">
                                Change Avatar
                                </div>
                            </a>
                        </div>
                        <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Save changes</button>
                       
                    </form>
                </div>
                <div class="card-footer">
                    {{-- <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button> --}}
                </div>
            </div>

       
        </div>
   
</x-layout>