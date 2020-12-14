@component('mail::message')
# User Activity Notification

The body of your message.

@component('mail::button', ['url' => ''])
Check
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
