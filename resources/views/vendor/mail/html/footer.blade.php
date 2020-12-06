<tr>
<td>
<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td class="content-cell" align="center">
    <div class="flex-row" style="display: flex;direction: row;flex-wrap: nowrap;gap: 15px;margin-bottom: 15px;justify-content: center;">
        <a href="https://www.facebook.com/duftunddu/"><img class="flex-img-child" src="{{ asset('images/vector_graphics/icons_pack/018-facebook-45.png') }}" alt="Facebook"></a>
        <a href="https://www.instagram.com/duftunddu/"><img class="flex-img-child" src="{{ asset('images/vector_graphics/icons_pack/instagram-45.png') }}" alt="Instagram"></a>
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
