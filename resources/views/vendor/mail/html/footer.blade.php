<tr>
<td>
<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td class="content-cell" align="center">
<div style="display: flex; direction: row; flex-wrap: nowrap; gap: 15px; margin-bottom: 15px; justify-content: center;">
<a href="https://www.facebook.com/duftunddu/"><img class="flex-img-child" src="{{ asset('images/vector_graphics/icons_pack/018-facebook-45.png') }}" alt="Facebook" style="display: flex; justify-content:center;"></a>
<a href="https://www.instagram.com/duftunddu/"><img class="flex-img-child" src="{{ asset('images/vector_graphics/icons_pack/instagram-45.png') }}" alt="Instagram" style="display: flex; justify-content:center;"></a>
</div>
{{ Illuminate\Mail\Markdown::parse("If you have any queries, you can mail us at <a href='mailto:customer-support@duftunddu.com'>customer-support@duftunddu.com</a>.") }}
{{ Illuminate\Mail\Markdown::parse("Established in Karachi, Pakistan.") }}
{{ Illuminate\Mail\Markdown::parse($slot) }}
</td>
</tr>
</table>
</td>
</tr>
