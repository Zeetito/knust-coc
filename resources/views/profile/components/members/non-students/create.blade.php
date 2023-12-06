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


                            {{-- Residence List for Each Zone --}}
                            {{-- Residence Id --}}
                            <div class="col-md-3 mb-4">
                                <strong>Select Residence</strong>
                                <input list="search_result_for_residence_list" autocomplete="off"  value="{{old('residence_id')}}" id="for_residence_list"  data-url="{{route('profile_search_residences')}}" class=" search_box form-control" name="residence_id" id="residence" placeholder="Residence search..." >
                                <datalist id="search_result_for_residence_list">
                                    @if(empty($residences))

                                        <option>Search residence...</option>
                                        @else
                                    
                                        @foreach($residences as $residence)
                                            <option value="{{$residence->name}}"></option>
                                        @endforeach

                                    @endif
                                </datalist>
                                @error('residence_id')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror

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
                            <div class="col-md-3 mb-4">
                                <strong>School Vodafone</strong>
                                <input type="text" class="form-control" value="{{old('school_voda')}}" name="school_voda">
                            </div>

                            {{-- Other Contact --}}
                            <div class="col-md-3 mb-4">
                                <strong>Other Contact (Optional)</strong>
                                <input type="text" class="form-control" value="{{old('other_contact')}}" name="other_contact">
                            </div>

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

                            <div class="col-md-6 mb-4">
                                <strong>Guardian Contact B (Optional) </strong>
                                <input type="text" class="form-control" value="{{old('guardian_b')}}" name="guardian_b" placeholder="Contact Here" >
                            </div>
                            <div class="col-md-6 mb-4">
                                <strong>Relation with Guardian B (Optional)</strong>
                                <input type="text" class="form-control" value="{{old('relation_b')}}" name="relation_b" placeholder="Eg. Father, Mother, etc">
                            </div>

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
