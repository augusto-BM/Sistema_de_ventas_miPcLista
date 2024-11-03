<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
        Pagar
    </h1>
    <form wire:submit.prevent='lugarPedido'>
        <div class="grid grid-cols-12 gap-4">
            <div class="md:col-span-12 lg:col-span-8 col-span-12">
                <!-- Card -->
                <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                    <!-- Shipping Address -->
                    <div class="mb-6">
                        <h2 class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                            Dirección de envío
                        </h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="first_name">
                                    Nombre
                                </label>
                                <input wire:model='nombres'
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('nombres') border-red-500 @enderror"
                                    id="first_name" type="text">
                                </input>
                                @error('nombres')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="last_name">
                                    Apellidos
                                </label>
                                <input wire:model='apellidos'
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('apellidos') border-red-500 @enderror"
                                    id="last_name" type="text">
                                </input>
                                @error('apellidos')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-white mb-1" for="phone">
                                Telefono
                            </label>
                            <input wire:model='telefono'
                                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('telefono') border-red-500 @enderror"
                                id="phone" type="text">
                            </input>
                            @error('telefono')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-white mb-1" for="address">
                                Direccion
                            </label>
                            <input wire:model='direccion'
                                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('direccion') border-red-500 @enderror"
                                id="address" type="text">
                            </input>
                            @error('direccion')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-white mb-1" for="city">
                                Ciudad
                            </label>
                            <input wire:model='ciudad'
                                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('ciudad') border-red-500 @enderror"
                                id="city" type="text">
                            </input>
                            @error('ciudad')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="state">
                                    Estado
                                </label>
                                <input wire:model='estado'
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('estado') border-red-500 @enderror"
                                    id="state" type="text">
                                </input>
                                @error('estado')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="zip">
                                    Codigo Postal
                                </label>
                                <input wire:model='codigo_postal'
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('codigo_postal') border-red-500 @enderror"
                                    id="zip" type="text">
                                </input>
                                @error('codigo_postal')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-lg font-semibold mb-4">
                        Seleccione método de pago
                    </div>
                    <ul class="grid w-full gap-6 md:grid-cols-2">
                        <li>
                            <input wire:model='metodo_pago' class="hidden peer" id="hosting-small" required=""
                                type="radio" value="pagoContraEntrega" />
                            <label
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                                for="hosting-small">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">
                                        Pago contra entrega
                                    </div>
                                </div>
                                <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                                    viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2">
                                    </path>
                                </svg>
                            </label>
                        </li>
                        <li>
                            <input wire:model='metodo_pago' class="hidden peer" id="hosting-big" type="radio"
                                value="stripe">
                            <label
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700"
                                for="hosting-big">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">
                                        Stripe
                                    </div>
                                </div>
                                <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                                    viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2">
                                    </path>
                                </svg>
                            </label>
                            </input>
                        </li>
                    </ul>
                    @error('metodo_pago')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <!-- End Card -->
            </div>
            <div class="md:col-span-12 lg:col-span-4 col-span-12">
                <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                    <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                        RESUMEN DEL PEDIDO
                    </div>
                    <div class="flex justify-between mb-2 font-bold">
                        <span>
                            Subtotal
                        </span>
                        <span>
                            {{ Number::currency($cantidad_total, 'PEN') }}
                        </span>
                    </div>
                    <div class="flex justify-between mb-2 font-bold">
                        <span>
                            Impuestos
                        </span>
                        <span>
                            {{ Number::currency(0, 'PEN') }}
                        </span>
                    </div>
                    <div class="flex justify-between mb-2 font-bold">
                        <span>
                            Costo de envío
                        </span>
                        <span>
                            {{ Number::currency(0, 'PEN') }}
                        </span>
                    </div>
                    <hr class="bg-slate-400 my-4 h-1 rounded">
                    <div class="flex justify-between mb-2 font-bold">
                        <span>
                            Total a Pagar
                        </span>
                        <span>
                            {{ Number::currency($cantidad_total, 'PEN') }}
                        </span>
                    </div>
                    </hr>
                </div>
                <button type="submit"
                    class="bg-green-500 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600">
                    <span wire:loading.remove>Realizar pedido</span>
                    <span wire:loading>Procesando...</span>
                </button>
                <div class="bg-white mt-4 rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                    <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">

                        RESUMEN DE LA CESTA
                    </div>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
                        @foreach ($productos_carrito as $producto)
                            <li class="py-3 sm:py-4" wire:key='{{ $producto['product_id'] }}'>
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="{{ $producto['name'] }}" class="w-12 h-12 rounded-full"
                                            src="{{ url('storage', $producto['image']) }}">
                                        </img>
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{ $producto['name'] }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{ $producto['quantity'] }}
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        {{ Number::currency($producto['total_amount'], 'PEN') }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>
