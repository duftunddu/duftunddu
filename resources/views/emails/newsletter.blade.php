@component('mail::message')
# The Fragrance Hub

Hi {{$user->name}},
{{-- ## Hi user_name, --}}
<br>

@component('mail::panel')
We are excited to announce that we are launching on 7/Dec/20.
@endcomponent

Duft Und Du is an online service which gives personal fragrance insights.
No more reading reviews from people who have nothing in common with you.
<br><br>

@component('mail::panel')
<img src="{{ asset('images/for_emails/indoor_outdoor.png') }}" alt="Indoor Outdoor" style="object-fit:contain; display:block; margin:auto; max-width:500px; height:auto;">
@endcomponent
<br>

You can ensure if your favorite brand is on Duft Und Du and add a request if they are not, <a href="https://duftunddu.com/request_brand_view">here</a>.
<br>

If you think we are missing something, or want to suggest a feature you can put in a request <a href="https://duftunddu.com/request_feature_view">here</a>.
<br>

For more information, visit <a href="https://duftunddu.com/faq">FAQ</a>.
<br><br>


Regards,<br>
{{ config('app.name') }}
<br><br>

<small class="center">
This is with regards to an email survey you filled out in the beginning of 2020.
</small>
<br><br>

<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td class="content" align="center">
{{ Illuminate\Mail\Markdown::parse("If you think this email is not meant for you, you can just ignore it. | <a href='/unsubscribe/$user->email/newsletter'>Unsubscribe</a>.") }}
{{-- {{ Illuminate\Mail\Markdown::parse("If you think this email is not meant for you, you can just ignore it. | <a href='/unsubscribe/user_id/newsletter'>Unsubscribe</a>.") }} --}}
</td>
</tr>
</table>
@endcomponent
