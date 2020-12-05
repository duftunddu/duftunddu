@component('mail::message')
# The Fragrance Hub

@component('mail::panel')
{{-- ## Hi! You are receiving this message because people asked for your brand. --}}
## Hi! user_name
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
<div class="image">
<img src="{{ asset('images/for_emails/ambassador-chart-better.png') }}" alt="Brand Ambassador Proposal">
</div>
@endcomponent
    
end

@component('mail::panel')
<img src="{{ asset('images/for_emails/ambassador_proposal_final.jpg') }}" alt="Brand Ambassador Proposal" style="object-fit:contain; display:block; margin:auto; max-width:500px; height:auto;">
@endcomponent
<br> 

You can add your fragrances to the portal by becoming a brand ambassador in simple steps mentioned <a href="https://duftunddu.com/brand_ambassador_proposal">here</a>.
<br> 

@component('mail::panel')
#### The first 50 brands to join will start with 50$ in their ad-wallet, which they can use at any time.
#### Santa's coming for presents in a few days, by the way. 😏
@endcomponent
<br> 

After adding your fragrances, you'll get exclusive access to the Ambassador Dashboard, where you can track user activity, free of cost of course.
<br> 

@component('mail::panel')
<div class="image">
<img src="{{ asset('images/for_emails/ambassador-chart-better.png') }}" alt="Brand Ambassador Proposal">
</div>
@endcomponent

@component('mail::button', ['url' => 'https://duftunddu.com'])
Join Now
@endcomponent

We don't add the fragrances ourselves or outsource it to a third-party to preserve the authenticity of the brand and its fragrances.
<br> 

@component('mail::panel')
We are officially launching on 7/Dec/2020. That should give you ample time to set up.
<br> 

If you have any queries, you can mail us at <a href="mailto:customer-support@duftunddu.com">customer-support@duftunddu.com</a>.
@endcomponent



Regards,<br>
{{ config('app.name') }}
@endcomponent
