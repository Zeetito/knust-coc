<p>
   Dear {{$email->user->fullname()}}
</p>
<p>
  
    <p>
        {{$email->body}}
    </p>

    <a class="h2" href="{{route('login')}}">Click to LogIn</a>

</p>

