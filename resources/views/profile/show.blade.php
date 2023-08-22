<x-layout>

    @if(!empty($profile))
More about 
    {{ $profile->lastname }}
    @else
    <div class="row" style="justify-items:center">
            <div class="col-sm-6 col-md-8">
                <div class="card border-warning">
                    <div class="card-header">
                        No Info To Show
                    </div>
                    <div class="card-body">
                        
                        <span class="title">
                            Help Us Know more about You.
                        </span>
                    <a href="{{route('edit_user_profile_form')}}">
                            <button class="btn btn-primary">
                                Complete Profile
                            </button>
                        </a>

                    </div>
                </div>
            </div>
            <!--/.col-->
           
        </div>
    @endif

</x-layout>