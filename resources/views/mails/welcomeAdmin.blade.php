@component('mail::message')
# Introduction

The body of your message.
[logo]
[logo]:{{asset('imagenes/bienvenida.jpg')}}
@component('mail::button', ['url' => "{$url}/register/adminRegister/{$club}"])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent