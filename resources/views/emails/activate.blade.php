@component('mail::message')
# Hello {{$user->first_name}},

Thank you for registering with [IndexBase Hub](https://indexbasehub.com/) You received this message because it is important that we verify your address. Click the button below to proceed.

@component('mail::button', ['url' =>  route('user.activate',[$token])])
Verify Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
