@component('mail::message')
Bienvenue {{$user->name}}

Merci de vous être enregistré(e) avec l'adresse {{$user->email}}
@endcomponent

@endcomponent
