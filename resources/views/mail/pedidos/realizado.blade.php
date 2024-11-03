<x-mail::message>
# Pedidos Realizado exitosamente

Gracias por su compra. El numero de tu pedido es: {{ $pedido->id }}.

<x-mail::button :url="$url">
Ver Pedido
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
