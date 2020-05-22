@component('mail::message')

@php
echo $messages
@endphp
<br>
<br>
{{ config('app.name') }}
@endcomponent
