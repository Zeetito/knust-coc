<x-layout>
      
        
    <div class="bg-white">

                {{-- Each Whole Table Screen --}}
                <div class="process-bar">
                    <div class="process-bar">
                        <div class="process-order">
                            <h3 style="text-align:center">Forgot Password Requests</h3>

                        </div>

                        {{-- Attendance Table --}}
                        <div class="" >

                                <div class="card-body">
                                        <table class="table datatable table-striped table-bordered">
                                            {{-- Table Head --}}
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Reset Link</th>
                                                </tr>
                                            </thead>
                                            {{-- Table Body --}}
                                            <tbody class="search_result">
                                                @foreach(App\Models\FP::where('handled',0)->get() as $fp)

                                                <tr id="tr_{{$fp->id}}">
                                                        {{-- Role Name --}}
                                                    <td>
                                                       {{$fp->user()->fullname()}}
                                                    </td>
                                                    {{-- Number of Users --}}
                                                    <td>
                                                       {{$fp->email}}
                                                    </td>
                                                    
                                                    {{-- Description --}}
                                                    <td>
                                                       Hello {{$fp->user()->firstname}}, Please Use the link below to reset your password. <br>
                                                       <a href="{{route('fp_reset_page',['email'=>$fp->email])}}">{{route('fp_reset_page',['email'=>$fp->email])}}</a> 
                                                    </td>

                                                    {{-- Actions --}}
                                                    


                                                   
                                                </tr>
                                              @endforeach

                                            </tbody>
                                            {{-- Table Body Ends --}}
                                        </table>
                                       
                                </div>
                        
                         
                        </div>
                        {{--Users Table Ends--}}

                        {{-- {{$role->links()}} --}}
                       
                    </div>
                </div>
                {{-- Whole Table Screen Ends --}}

               



        </div>
        <!-- /.conainer-fluid -->

</x-layout>