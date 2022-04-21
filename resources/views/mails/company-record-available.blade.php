@component('mail::message')
# Hi {{ $user->name }}

The information about {{ $companyRecordRequest->company_name }} is now available at the find company record enpoint.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
