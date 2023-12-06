<x-layout>

    <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong>Create An <h3>Alumini</h3> Profile</strong>

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

                            {{-- Country --}}
                            <div class="col-md-3 mb-4">
                                Country 
                                <input list="search_result_for_country_list" autocomplete="off"  value="{{old('country')}}" id="for_country_list"  data-url="" class=" search_box form-control" name="country" id="residence" placeholder="Country search..." >
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
                                <input type="text" autocomplete="off"  class="form-control" name="state" id="state">
                                @error('state')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror
                            </div>
                            
                            {{-- City/Town --}}
                            <div class ="col-md-3 mb-4">
                                City - Town
                                <input type="text" autocomplete="off" class="form-control" name="city" id="city">
                                @error('town')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror
                            </div>

                            {{-- Local Congregation --}}
                            <div class ="col-md-3 mb-4">
                                Local Congregation
                                <input type="text" autocomplete="off" class="form-control" name="local_congregation" id="local_congregation">
                                @error('local_congregation')
                                <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                @enderror
                            </div>

                            {{-- Year Group Id --}}
                            <div class="col-md-3 mb-4">
                                    <select class="form-control" autocomplete="off" name="year_group_id" id="year_group_id">
                                        <option value="" >Select Year Group</option>
                                        @foreach(App\Models\YearGroup::all()->sortByDesc('year') as $year_group)
                                            <option value="{{$year_group->id}}"> {{$year_group->name}} </option>
                                        @endforeach
                                    </select>
                                {{-- <span class="help-block">Zone</span> --}}
                                {{-- Error Message --}}
                                    @error('year_group_id')
                                    <p class='m=0 small alert alert-danger shadow-sm'>{{$message}}</p>
                                    @enderror
                            </div>

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
                                <input type="text" class="form-control" value="{{old('guardian_a')}}" name="guardian_a" placeholder="Contact Here" >
                            </div>
                            <div class="col-md-6 mb-4">
                                <strong>Relation with Guardian A</strong>
                                <input type="text" class="form-control" value="{{old('relation_a')}}" name="relation_a" placeholder="Eg. Father, Mother, etc" >
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
