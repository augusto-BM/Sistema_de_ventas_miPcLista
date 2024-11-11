<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-slate-500">Mis Pedidos</h1>
    <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Pedido</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Fecha</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Estado del
                                    Pedido</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Estado de
                                    Pago</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Cantidad de
                                    Pedido</th>
                                <th scope="col"
                                    class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mis_pedidos as $pedido)
                                @php
                                    $estado = '';
                                    $estado_pago = '';

                                    if ($pedido->estado == 'nuevo') {
                                        $estado =
                                            '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Nuevo</span>';
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

                                    if($pedido->estado_pago == 'pendiente'){
                                        $estado_pago = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Pendiente</span>';
                                    }elseif($pedido->estado_pago == 'pagado'){
                                        $estado_pago = '<span class="bg-green-600 py-1 px-3 rounded text-white shadow">Pagado</span>';
                                    }elseif($pedido->estado_pago == 'fallido'){
                                        $estado_pago = '<span class="bg-red-600 py-1 px-3 rounded text-white shadow">Fallido</span>';
                                    }
                                @endphp

                                <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800"
                                    wire:key = '{{ $pedido->id }}'>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                        {{ $pedido->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $pedido->created_at->format('d-m-Y') }}</td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {!! $estado !!}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {!! $estado_pago !!}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ Number::currency($pedido->total_pagar, 'PEN') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <a wire:navigate href="/mis-pedidos/{{ $pedido->id }}"
                                            class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500">Ver
                                            Detalles</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- Paginacion --}}
            {{ $mis_pedidos->links() }}
        </div>
    </div>
</div>
