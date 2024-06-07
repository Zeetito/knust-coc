<x-layout>
      
        
    <div class="container-fluid">

                {{-- Each Whole Table Screen --}}
                <div class=" card process-bar">
                        <div class="process-order">
                            <h6 style="text-align:center">{{$remarkerable->name}}</h6> 
                        
                        </div>

                        <div class="" >

                                <div class="card-body">
                                        {{-- Form Pic --}}
                                        <div class="contianer row">
                                                <div class="card col-12">
                                    
                                                    <div class="card-header">
                                                        Remark / Note On <strong>{{$remarkable->fullname() ? $remarkable->fullname() : $remarkable->name}}</strong> - {{App\Models\Semester::active_semester()->academic_name()}}

                                                        <a href="{{route('home')}}" class="float-right btn btn-secondary m-2">Home</a>
                                                        
                                                        @foreach(auth()->user()->roles as $role)
                                                                    <a href="{{route('ministry_remark_session',['ministry'=>$role, 'semester'=>App\Models\Semester::active_semester()])}}" class="m-2  text-wrap float-right btn btn-secondary">{{$role->name}} Remark Session</a>
                                                        @endforeach
                                    
                                                    </div>

                                                    <div class="card-body">

                                                        {{-- form for add --}}

                                                        <form action="{{route('store_remark_record')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                                @csrf
                                    
                                                                <textarea name="body" id="" class="form-control" cols="5" rows="5" 
                                                                    placeholder="1. He has never been to Church">
                                                                    {{-- {{old('body',$remarkable->remark_from($remarkerable_type, $remarkerable->id, App\Models\Semester::active_semester()->id))}} --}}
                                                                </textarea>

                                                                <input type="text" name="remarkable_id" value="{{$remarkable->id}}" hidden>
                                                                <input type="text" name="remarkable_type" value="{{$remarkable_type}}" hidden>
                                                                <input type="text" name="remarkerable_id" value="{{$remarkerable->id}}" hidden>
                                                                <input type="text" name="remarkerable_type" value="{{$remarkerable_type}}" hidden>
                                                                <input type="text" name="remark_id" value="{{$remarkable->remark_from($remarkerable_type, $remarkerable->id, App\Models\Semester::active_semester()->id) ? $remarkable->remark_from($remarkerable_type, $remarkerable->id, App\Models\Semester::active_semester()->id)->id : null}}" hidden>

                                                                <select name="type" class="mt-2 form-control" id="" required>
                                                                    <option value="">Select Type</option>
                                                                    <option value="benevolence">Benevolence</option>
                                                                    <option value="remark">Remark</option>
                                                                </select>
                                    
                                                            <button type="submit" name="submit" class="btn btn-sm btn-primary m-2"><i class="fa fa-dot-circle-o"></i> Add Entry</button>
                                    
                                                        </form>

                                                        @if($remark)
                                                            <div class="table-responsive">
                                                                <table class="table datatable table-striped table-primary">
                                                                    <thead>
                                                                        <th>Type</th>
                                                                        <th>Info</th>
                                                                        <th>Recorded by</th>
                                                                        <th>Actions</th>
                                                                    </thead>

                                                                    <tbody>
                                                                        @foreach($remark->records as $record)

                                                                            <tr>
                                                                                <td>{{$record->type}}</td>
                                                                                <td>{{$record->body}}</td>
                                                                                <td>{{$record->recorded_by->fullname()}}</td>
                                                                                <td>
                                                                                    <i data-toggle="modal" data-target="#myModal" data-url="{{route('edit_remark_record',['remark_record'=>$record])}}"  class="mr-2 fa fa-edit"></i>
                                                                                    <i data-toggle="modal" data-target="#myModal" data-url="{{route('confirm_delete_remark_record',['remark_record'=>$record])}}" class="mr-2 fa fa-trash"></i>
                                                                                </td>
                                                                            </tr>

                                                                        @endforeach
                                                                    </tbody>

                                                                </table>
                                                            </div>
                                                        @else
                                                            <div> {{$remarkerable->name ? $remarkerable->name : $remarkerable->fullname()}} has no entries for {{$remarkable->name ? $remarkable->name : $remarkable->fullname()}}</div>
                                                        @endif


                                                    </div>
                                                    
                                                    <div class="card-footer">
                                                        {{-- <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button> --}}
                                                    </div>
                                                </div>

                                                
                                    
                                    
                                            </div>
                                    
                                    
                                        </div>

                                </div>
                        
                         
                        </div>

                       
                </div>
                {{-- Whole Table Screen Ends --}}

    </div>
        <!-- /.conainer-fluid -->

</x-layout>