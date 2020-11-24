@component('mail::message')
# The Fragrance Hub

@component('mail::panel')
Hi! You are receiving this message because people asked for your brand.
@endcomponent

Duft Und Du is an online fragrance portal startup where you can list out your fragrances.
<br>

<img src="{{ asset('images/for_emails/ambassador_proposal_final.png') }}" alt="Ambassador Proposal" style="object-fit:contain; display:block; margin:auto; max-width:500px; height:auto;">

We conducted a survey to find out favourite brands of people, and your brand was mentioned by many.


You can add your fragrances to the portal by assigning a brand ambassador in simple steps mentioned <a href="https://duftunddu.com/brand_ambassador_proposal">here</a>.

@component('mail::button', ['url' => 'https://duftunddu.com'])
Join Now
@endcomponent

We don't add the fragrances ourselves or outsource it to a third-party to preserve the authenticity of the brand and its fragrances.


@component('mail::panel')
We are officially launching on 28/Nov/2020. That should give you ample time to set up.

If you have any queries, you can mail us at <a href="mailto:customer-support@duftunddu.com">customer-support@duftunddu.com</a>.
@endcomponent



Regards,<br>
{{ config('app.name') }}
@endcomponent
