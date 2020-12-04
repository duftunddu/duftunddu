<tr>
<td>
<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td class="content-cell" align="center">
    <div class="flex-row">
        <a href="https://www.facebook.com/duftunddu/"><img class="flex-img-child" src="{{ asset('images/vector_graphics/icons_pack/018-facebook.png') }}" alt="Facebook"></a>
        <a href="https://www.instagram.com/duftunddu/"><img class="flex-img-child" src="{{ asset('images/vector_graphics/icons_pack/instagram.png') }}" alt="Instagram"></a>
    </div>
    {{ Illuminate\Mail\Markdown::parse("For any queries, contact customer-support@duftunddu.com.") }}
    {{ Illuminate\Mail\Markdown::parse("Established in Karachi, Pakistan.") }}
    {{-- {{ Illuminate\Mail\Markdown::parse("Established in Karachi, Pakistan. | <a href='/unsubscribe/{$email_type}/{$user_id}'>Unsubscribe</a>.") }} --}}
    {{ Illuminate\Mail\Markdown::parse($slot) }}
</td>
</tr>
</table>
</td>
</tr>
