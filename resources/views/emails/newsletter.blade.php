@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => 'https://duftunddu.com'])
Join Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
