@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{asset('/assets/mail-assets/icon.png')}}" class="logo" alt="Resrel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
