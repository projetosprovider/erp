@component('mail::message')

# Olá!

A compra do seu plano {{ $delivery->id }} foi realizada com sucesso.

@component('mail::button', ['url' => $url])
Acessar Site
@endcomponent

Muito Obrigado,<br>
Equipe {{ config('app.name') }}
@endcomponent
