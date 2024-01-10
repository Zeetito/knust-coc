<x-layout>

    <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>User Profile</strong>
                    
                </div>
                <div class="card-body">
                <form action="{{route('update_profile',['user'=>$user])}}" method="post" class="form-horizontal">
                        @csrf
                        @method('PUT')
                        {{-- UserName --}}
                        <div class="form-group row">
                            {{-- <label class="col-md-3 form-control-label">Hello</label> --}}
                            <div class="col-md-6">
                                <p class="form-control-static">Hello {{$user->username}} Help us know more about you</p>
                            </div>
                        </div>

                        <div class="form-group row">
                           

                            {{-- Country --}}
                            <div class="col-md-3 mb-4">
                                <h6>Country</h6>
                                <input list="search_result_for_country_list" autocomplete="off"  value="{{old('country',$user->biodata->country)}}" id="for_country_list"  data-url="" class=" search_box form-control" name="country" id="residence" placeholder="Country search..." >
                                <datalist id="search_result_for_country_list">
                                        {{-- @if(empty($countries)) --}}
                                            <option>Search Country...</option>
                                        {{-- @else --}}
                                    
                                        {{-- @foreach($residences as $residence)
                                            <option value="{{$residence->name}}"></option>
                                        @endforeach --}}

                                        {{-- @endif --}}
                                </datalist>
                                @error('country')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror
                            </div>

                            
                            {{-- State/Region --}}
                            <div class ="col-md-3 mb-4">
                                State/Region
                                <input type="text" value="{{old('state',$user->biodata->state)}}" autocomplete="off"  class="form-control" name="state" id="state">
                                @error('state')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror
                            </div>
                            
                            {{-- City/Town --}}
                            <div class ="col-md-3 mb-4">
                                City - Town
                                <input type="text" value="{{old('city',$user->biodata->city)}}" autocomplete="off" class="form-control" name="city" id="city">
                                @error('town')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror
                            </div>

                            {{-- Local Congregation --}}
                            <div class ="col-md-3 mb-4">
                                Local Congregation
                                <input type="text" value="{{old('local_congregation',$user->biodata->local_congregation)}}" autocomplete="off" class="form-control" name="local_congregation" id="local_congregation">
                                @error('local_congregation')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror
                            </div>

                            {{-- @if($user->biodata->is_alumni == 1) --}}
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
                            {{-- @endif --}}

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
                                <input type="text" class="form-control" value="{{old('guardian_a',$user->main_guardian_contact == null ? "" : $user->main_guardian_contact->body )}}" autocomplete="off" name="guardian_a" placeholder="Contact Here" >
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