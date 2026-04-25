<x-mail::message>

# Welcome {{ $user->name }}

Thanks for joining us 🎉  
We’re happy to have you here.


<x-mail::button :url="'(/)'">
Go To Website
</x-mail::button>
    
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
