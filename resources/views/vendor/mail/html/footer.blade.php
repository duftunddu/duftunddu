<tr>
<td>
<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td class="content-cell" align="center">
    {{ Illuminate\Mail\Markdown::parse("For any queries, contact customer-support@duftunddu.com.") }}
    {{ Illuminate\Mail\Markdown::parse("Established in Karachi, Pakistan. | <a href='/unsubscribe'>Unsubscribe</a>.") }}
    {{-- {{ Illuminate\Mail\Markdown::parse("Established in Karachi, Pakistan. | <a href='/unsubscribe/{$email_type}/{$user_id}'>Unsubscribe</a>.") }} --}}
    {{ Illuminate\Mail\Markdown::parse($slot) }}
</td>
</tr>
</table>
</td>
</tr>
