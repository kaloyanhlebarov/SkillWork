@component('mail::message')
# Hi {{ $user->name }}

This is your reset password token:<br>
{{ $token }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
