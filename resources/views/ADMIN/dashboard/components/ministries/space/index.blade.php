<x-layout>

    {{-- This Page May contain A History Of All Activities of the Welfare. --}}
    {{-- SubPages may contain sub features --}}
    <div class="card-body bg-white">

        <a href="{{route('admin_home')}}" class="btn-secondary btn float-right">Go Back</a>

        <div class="h6 " >
            {{$ministry->name}} Space
        </div>

        <div class="row nav">

            <span class="col-3 btn"> <a class="btn-info " href="">History</a> </span>

            <span class="col-3 btn"> <a class="btn" href="{{route('ministry_account_sessions',['ministry'=>$ministry])}}">Accounts</a> </span>

            <span class="col-3 btn"> <a class="btn" href="">Info</a> </span>

            <span class="col-3 btn"> <a class="btn" href="">Archive</a> </span>

        </div>

    </div>

</x-layout>