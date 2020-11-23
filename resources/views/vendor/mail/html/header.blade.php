<tr>
<td class="header">
{{-- <a style="font-variant:small-caps;" href="{{ $url }}" style="display: inline-block;"> --}}
    <a style="font-variant:small-caps;" href="https://duftunddu.com" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
{{-- <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo"> --}}
<img src="{{ asset('images/logo_header.png') }}" class="logo" alt="Laravel Logo">
@else
<img src="{{ asset('images/logo_header.png') }}" class="logo" alt="Laravel Logo">
{{ $slot }}
@endif
</a>
</td>
</tr>
