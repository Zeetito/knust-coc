<x-mail::message>
<p>Hello {{$name }}</p>


<x-mail::button :url="url('reset-password/' . $remember_token)">
    Reset Your Password
</x-mail::button>

<p>Contact Any of The Leadership or Reps if you face any Issues.</p>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
