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