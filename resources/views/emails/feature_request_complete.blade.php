@component('mail::message')
# The Fragrance Hub

@component('mail::panel')
Congratulations!
You have earned a badge.
@endcomponent
<br>

Hi {{$user->name}},
{{-- Hi user_name, --}}
<br>

The feature request you put in, has been accepted, and delivered.
<br>

@component('mail::panel')
## {{ $feature->name }}
{{-- ## feature_name --}}
{{ $feature->description }}
{{-- feature_description --}}
@endcomponent
<br><br>

@component('mail::panel')
<img src="{{ asset('images/for_emails/indoor_outdoor.png') }}" alt="Indoor Outdoor" style="object-fit:contain; display:block; margin:auto; max-width:500px; height:auto;">
@endcomponent
<br>


Regards,<br>
{{ config('app.name') }}
@endcomponent
