@component('mail::message')
# You are registred! 

Hi {{ $user->name }} this is an e-mail example.

@component('mail::button', ['url' => 'https://google.com'])
Click Here
@endcomponent

Tanks,<br>
{{ config('app.name') }}
@endcomponent
