<x-layout>
      
    <div class=" card ">

        <div class="container-fluid">
            <span class="float-right btn h2 bg-info">{{$user->program()->name}}</span>
            {{-- Search User --}}
            {{-- <span class="form-control card">
                <form >
                    <input type="text" class="search_box" id="for_program_mate_list" data-url="{{route('search_program_mates',['user'=>$user])}}" placeholder="search name..." style="text-align:center;">
                        <i class="fa fa-search"></i>
                </form>
            </span> --}}

            {{-- Filter User --}}
            {{-- <span calss="form-control card float-right"> --}}
                {{-- <form > --}}
                    {{-- <select type="text" id="_for_program_mate_list" class="filter_box" data-url="{{route('filter_program_mates',['user'=>$user])}}" >    
                        <option>Filter By </option>
                        <option value="same">YearGroup</option>
                        <option value="junior">Junior Program Mates</option>
                        <option value="senior">Senior Program Mates</option> --}}
                        {{-- 
                        <option value="latest">Latest</option>
                        <option value="oldest">oldest</option> --}}
                    {{-- </select>        
                    <i class="fa fa-filter"></i>                                       
                </form>
            </span> --}}

        </div>

        <div id="search_result_for_program_mate_list" class=" row ">
            {{-- Each Account will sit in this --}}
            @foreach($user->program_mates() as $mate)
                <div class="col-sm-3 col-md-2 mt-3">
                    {{-- If User is a Fresher --}}

                    {{-- @if($user->inactive_account_reason() == 'fresher') --}}
                    <a class="card text-white bg-info" data-toggle="" data-target="#myModal" >
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                <i>
                                    <img src="{{$mate->get_avatar()}}"  style="width:35px; height:35px;"  class="img-avatar" alt="Profile Picture">
                                </i>
                            </div>
                            {{-- <div class=" mb-0">{{$mate->created_at->diffInDays(now())}} Days Ago</div> --}}
                            <small class="text-uppercase font-weight-bold">{{$mate->fullname()." - Year : ".$mate->year()}} </small>
                            
                            <div class="progress progress-white progress-xs mt-3">
                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </a>
            
                    {{-- @endif --}}


                </div>
            @endforeach
        </div>

    </div>

</x-layout>
