@component('mail::message')
# The Fragrance Hub

@component('mail::panel')
{{-- ## Hi! user_name --}}
## Hi! {{$user->name}},
### Welcome to Duft Und Du.
@endcomponent

We are an online fragrance portal where you can list out your fragrances to increase your reach.
We provide users with personalized fragrance insights, which no other service does, *we checked*.
<br>

@component('mail::panel')
<img src="{{ asset('images/for_emails/ambassador_proposal_final.jpg') }}" alt="Brand Ambassador Proposal" style="object-fit:contain; display:block; margin:auto; max-width:500px; height:auto;">
@endcomponent
<br> 

You can add your fragrances to the Duft Und Du by becoming a Brand Ambassador in a few simple steps mentioned <a href="https://duftunddu.com/brand_ambassador_proposal">here</a>.
This will:
1. Increase the reach of your brand.
2. Get you exclusive access to the Ambassador Dashboard, where you can track user activity.
3. Get you 50$ in your Duft Und Du ad-wallet.
<br>

All of this free of cost.<br>
And you can assign upto 3 Brand Ambassadors to manage your brand.
<br>

@component('mail::panel')
Personal Insights
<br><br>
<img src="{{ asset('images/for_emails/indoor_outdoor.png') }}" alt="Personalized Insights" style="object-fit:contain; display:block; margin:auto; max-width:500px; height:auto;">
@endcomponent
<br>

@component('mail::panel')
Ambassador Dashboard
<br><br>
<img src="{{ asset('images/for_emails/ambassador-chart-better_final.png') }}" alt="Brand Ambassador Dashboard" style="object-fit:contain; display:block; margin:auto; max-width:500px; height:auto;">
@endcomponent
<br>

@component('mail::panel')
##### The first 50 brands to join will start with 50$ in their ad-wallet, which they can use at any time.
##### Santa's coming for presents in a few days, by the way. 😏
@endcomponent
<br> 


@component('mail::panel')
We are officially launching on 7/Dec/2020. The clock is ticking. ⏱
<br> 

If you have any queries, you can mail us at <a href="mailto:customer-support@duftunddu.com">customer-support@duftunddu.com</a>.
@endcomponent
<br>


@component('mail::button', ['url' => 'https://duftunddu.com'])
Join Now
@endcomponent
<br> 

We don't add the fragrances ourselves or outsource it to a third-party to preserve the authenticity of the brand and its fragrances.
<br>

Regards,<br>
{{ config('app.name') }}
@endcomponent
