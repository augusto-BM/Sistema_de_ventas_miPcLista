<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-slate-500">Detalles Pedidos</h1>

    <!-- Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-5">
        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div
                    class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            Cliente
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        <div>{{ $direcciones->nombre }} {{ $direcciones->apellido }}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div
                    class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M5 22h14" />
                        <path d="M5 2h14" />
                        <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22" />
                        <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            Fecha Pedido
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl font-medium text-gray-800 dark:text-gray-200">
                            {{ $detalle_pedidos[0]->created_at->format('d-m-Y') }}</td>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div
                    class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M21 11V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6" />
                        <path d="m12 12 4 10 1.7-4.3L22 16Z" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            Estado Pedido
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        @php
                            $estado = '';
                            $estado_pago = '';

                            if ($pedido->estado == 'nuevo') {
                                $estado = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Nuevo</span>';
                            } elseif ($pedido->estado == 'procesando') {
                                $estado =
                                    '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Procesando</span>';
                            } elseif ($pedido->estado == 'enviado') {
                                $estado =
                                    '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Enviado</span>';
                            } elseif ($pedido->estado == 'entregado') {
                                $estado =
                                    '<span class="bg-green-700 py-1 px-3 rounded text-white shadow">Entregado</span>';
                            } elseif ($pedido->estado == 'cancelado') {
                                $estado =
                                    '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Cancelado</span>';
                            }

                        @endphp
                        {!! $estado !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->

        <!-- Card -->
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div
                    class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M5 12s2.545-5 7-5c4.454 0 7 5 7 5s-2.546 5-7 5c-4.455 0-7-5-7-5z" />
                        <path d="M12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        <path d="M21 17v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2" />
                        <path d="M21 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2" />
                    </svg>
                </div>

                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            Estado Pedido
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        @php
                            if ($pedido->estado_pago == 'pendiente') {
                                $estado_pago =
                                    '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Pendiente</span>';
                            } elseif ($pedido->estado_pago == 'pagado') {
                                $estado_pago =
                                    '<span class="bg-green-600 py-1 px-3 rounded text-white shadow">Pagado</span>';
                            } elseif ($pedido->estado_pago == 'fallido') {
                                $estado_pago =
                                    '<span class="bg-red-600 py-1 px-3 rounded text-white shadow">Fallido</span>';
                            }
                        @endphp
                        {!! $estado_pago !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Grid -->

    <div class="flex flex-col md:flex-row gap-4 mt-4">
        <div class="md:w-3/4">
            <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left font-semibold">Producto</th>
                            <th class="text-left font-semibold">Precio</th>
                            <th class="text-left font-semibold">Cantidad</th>
                            <th class="text-left font-semibold">Total</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!--[if BLOCK]><![endif]-->
                        @foreach ($detalle_pedidos as $pedidos)
                            <tr wire:key="{{ $pedidos->id }}">
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img class="h-16 w-16 mr-4"
                                            src="{{ url('storage', $pedidos->producto->imagen[0]) }}"
                                            alt="{{ $pedidos->producto->nombre }}">
                                        <span class="font-semibold">{{ $pedidos->producto->nombre }}</span>
                                    </div>
                                </td>
                                <td class="py-4">{{ Number::currency($pedidos->monto_unitario, 'PEN') }}</td>
                                <td class="py-4">
                                    <span class="text-center w-8">{{ $pedidos->cantidad }}</span>
                                </td>
                                <td class="py-4">{{ Number::currency($pedidos->monto_total, 'PEN') }}</td>
                            </tr>
                        @endforeach
                        <!--[if ENDBLOCK]><![endif]-->

                    </tbody>
                </table>
            </div>

            <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
                <h1 class="font-3xl font-bold text-slate-500 mb-3">Direccion de Envio</h1>
                <div class="flex justify-between items-center">
                    <div>
                        <p>{{ $direcciones->direccion }}, {{ $direcciones->ciudad }}, {{ $direcciones->estado }},
                            {{ $direcciones->codigo_postal }}</p>
                    </div>
                    <div>
                        <p class="font-semibold">Telefono:</p>
                        <p>{{ $direcciones->celular }}</p>
                    </div>
                </div>
            </div>

        </div>
        <div class="md:w-1/4">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold mb-4">Resumen de Compra</h2>
                <div class="flex justify-between mb-2">
                    <span>Subtotal</span>
                    <span>{{ Number::currency($pedidos->pedido->total_pagar, 'PEN') }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Impuestos</span>
                    <span>{{ Number::currency(0, 'PEN') }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Envio</span>
                    <span>{{ Number::currency(0, 'PEN') }}</span>
                </div>
                <hr class="my-2">
                <div class="flex justify-between mb-2">
                    <span class="font-semibold">Total a Pagar</span>
                    <span class="font-semibold">{{ Number::currency($pedidos->pedido->total_pagar, 'PEN') }}</span>
                </div>

            </div>
        </div>
    </div>
</div>
