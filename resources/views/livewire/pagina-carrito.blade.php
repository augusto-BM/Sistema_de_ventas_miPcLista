<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-4">Carrito de Compras</h1>
        <div class="flex flex-col md:flex-row gap-4">
            <div class="md:w-3/4">
                <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="text-left font-semibold">Producto</th>
                                <th class="text-left font-semibold">Precio</th>
                                <th class="text-left font-semibold">Cantidad</th>
                                <th class="text-left font-semibold">Total</th>
                                <th class="text-left font-semibold">{{-- Eliminar --}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($productos_carrito as $producto)
                                <tr wire:key='{{ $producto['product_id'] }}'>
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <img class="h-16 w-16 mr-4" src="{{ url('storage', $producto['image']) }}"
                                                alt="{{ $producto['name'] }}">
                                            <span class="font-semibold">{{ $producto['name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4">{{ Number::currency($producto['unit_amount'], 'PEN') }}</td>
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <button wire:click='decrementarCantidad({{ $producto['product_id'] }})' class="border rounded-md py-2 px-4 mr-2">-</button>
                                            <span class="text-center w-8">{{ $producto['quantity'] }}</span>
                                            <button wire:click='incrementarCantidad({{ $producto['product_id'] }})' class="border rounded-md py-2 px-4 ml-2">+</button>
                                        </div>
                                    </td>
                                    <td class="py-4">{{ Number::currency($producto['total_amount'], 'PEN') }}</td>
                                    <td><button wire:click="eliminarProducto({{ $producto['product_id'] }})"
                                            class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700"><span wire:loading.remove wire:target='eliminarProducto({{ $producto['product_id'] }})'>Eliminar</span><span wire:loading wire:target='eliminarProducto({{ $producto['product_id'] }})'>Eliminando...</span></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-4xl font-semibold text-slate-500">No
                                        tienes productos añadidos al carrito</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="md:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold mb-4">Resumen de Compra</h2>
                    <div class="flex justify-between mb-2">
                        <span>Subtotal</span>
                        <span>{{ Number::currency($cantidad_total, 'PEN') }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Impuestos</span>
                        <span>{{ Number::currency(0, 'PEN') }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span>Envío</span>
                        <span>{{ Number::currency(0, 'PEN') }}</span>
                    </div>
                    <hr class="my-2">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Total a Pagar</span>
                        <span class="font-semibold">{{ Number::currency($cantidad_total, 'PEN') }}</span>
                    </div>
                    @if ($productos_carrito)
                        <a href="/pago" class="bg-blue-500 block text-center text-white py-2 px-4 rounded-lg mt-4 w-full">Pagar</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
