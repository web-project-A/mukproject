@component('mail::message')
# INTERNSHIP

Greetings, this email is to notify you as a field supervisor to register for the Makerere University Internship System. Simply click the "Register" button below.

@component('mail::button', ['url' => '/registerfieldsupervisor'])
Register
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
