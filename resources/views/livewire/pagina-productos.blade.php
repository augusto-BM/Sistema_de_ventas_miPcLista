<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="py-10 bg-gray-50 font-poppins dark:bg-gray-800 rounded-lg">
        <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
            <div class="flex flex-wrap mb-24 -mx-3">
                <div class="w-full pr-2 lg:w-1/4 lg:block">
                    <div class="p-4 mb-5 bg-white border border-gray-200 dark:border-gray-900 dark:bg-gray-900">
                        <h2 class="text-2xl font-bold dark:text-gray-400"> Categorias</h2>

                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                        <ul>
                            @foreach ($categorias as $categoria)
                                <li class="mb-4" wire:key="{{ $categoria->id }}">
                                    <label for="{{ $categoria->identificador_url }}"
                                        class="flex items-center dark:text-gray-400">
                                        <input type="checkbox" wire:model.live="categorias_seleccionadas"
                                            id="{{ $categoria->identificador_url }}" value="{{ $categoria->id }}"
                                            class="w-4 h-4 mr-2">
                                        <span class="text-lg">{{ $categoria->nombre }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                        <h2 class="text-2xl font-bold dark:text-gray-400">Marcas</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                        <ul>

                            @foreach ($marcas as $marca)
                                <li class="mb-4" wire:key="{{ $marca->id }}">
                                    <label for="{{ $marca->identificador_url }}"
                                        class="flex items-center dark:text-gray-300">
                                        <input type="checkbox" wire:model.live="marcas_seleccionadas"
                                            id="{{ $marca->identificador_url }}" value="{{ $marca->id }}"
                                            class="w-4 h-4 mr-2">
                                        <span class="text-lg dark:text-gray-400">{{ $marca->nombre }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                        <h2 class="text-2xl font-bold dark:text-gray-400">Estado del producto</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                        <ul>
                            <li class="mb-4">
                                <label for="destacado" class="flex items-center dark:text-gray-300">
                                    <input type="checkbox" id="destacado" wire:model.live="destacado" value="1"
                                        class="w-4 h-4 mr-2">
                                    <span class="text-lg dark:text-gray-400">Productos Destacados</span>
                                </label>
                            </li>
                            <li class="mb-4">
                                <label for="" class="flex items-center dark:text-gray-300">
                                    <input type="checkbox" id="en_oferta" wire:model.live="en_oferta" value="1"
                                        class="w-4 h-4 mr-2">
                                    <span class="text-lg dark:text-gray-400">En oferta</span>
                                </label>
                            </li>
                        </ul>
                    </div>

                    <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                        <h2 class="text-2xl font-bold dark:text-gray-400">Precio</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
                        <div>
                            <div class="font-semibold">{{ Number::currency($precio_rango, 'PEN') }}</div>
                            <input type="range" wire:model.live="precio_rango"
                                class="w-full h-1 mb-4 bg-blue-100 rounded appearance-none cursor-pointer"
                                max="15000" value="10000" step="100">
                            <div class="flex justify-between ">
                                <span
                                    class="inline-block text-lg font-bold text-blue-400 ">{{ Number::currency(100, 'PEN') }}</span>
                                <span
                                    class="inline-block text-lg font-bold text-blue-400 ">{{ Number::currency(15000, 'PEN') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full px-3 lg:w-3/4">
                    <div class="px-3 mb-4">
                        <div
                            class="items-center justify-between hidden px-3 py-2 bg-gray-100 md:flex dark:bg-gray-900 ">
                            <div class="flex items-center justify-between">
                                <select wire:model.live="ordenar"
                                    class="block w-55 text-base bg-gray-100 cursor-pointer dark:text-gray-400 dark:bg-gray-900">
                                    <option value="el_ultimo">Ordenar por el ultimo</option>
                                    <option value="el_precio">Ordenar por el precio</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Verificar si hay productos -->
                    @if ($productos->isEmpty())
                        <!-- Mostrar mensaje si no hay productos -->
                        <div
                            class="w-full p-6 text-center bg-yellow-100 text-yellow-700 border border-yellow-300 rounded-lg">
                            <p>No se encontraron productos que coincidan con los filtros seleccionados.</p>
                            
                        </div>
                    @else
                        <div class="flex flex-wrap items-stretch">
                            @foreach ($productos as $producto)
                                <div class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3" wire:key="{{ $producto->id }}">
                                    <div class="border border-gray-300 dark:border-gray-700 flex flex-col h-full">
                                        <!-- Imagen del producto -->
                                        <div class="relative bg-gray-200">
                                            <a wire:navigate href="/productos/{{ $producto->identificador_url }}">
                                                <img src="{{ url('storage/' . $producto->imagen[0]) }}"
                                                    alt="{{ $producto->nombre }}"
                                                    class="object-cover w-full h-56 mx-auto">
                                            </a>
                                        </div>

                                        <!-- Información del producto -->
                                        <div class="p-3 flex flex-col flex-grow">
                                            <div class="flex items-center justify-between gap-2 mb-2">
                                                <!-- Nombre del producto con alto máximo y truncado -->
                                                <h3
                                                    class="text-xl font-medium dark:text-gray-400 max-h-16 overflow-hidden overflow-ellipsis">
                                                    {{ $producto->nombre }}
                                                </h3>
                                            </div>

                                            <!-- Precio del producto-->
                                            <p class="text-lg mt-auto">
                                                <span
                                                    class="text-green-600 dark:text-green-600">{{ Number::currency($producto->precio, 'PEN') }}</span>
                                            </p>

                                            <!-- Botón de añadir al carrito -->
                                            <div
                                                class="flex justify-center p-4 border-t border-gray-300 dark:border-gray-700">
                                                <a wire:click.prevent='agregarAlCarrito({{ $producto->id }})'
                                                    href="#"
                                                    class="text-gray-500 flex items-center space-x-2 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="w-4 h-4 bi bi-cart3"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                                        </path>
                                                    </svg><span wire:loading.remove
                                                        wire:target='agregarAlCarrito({{ $producto->id }})'>Añadir al
                                                        carrito</span><span wire:loading
                                                        wire:target='agregarAlCarrito({{ $producto->id }})'>Añadiendo...</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- pagination start -->
                    <div class="flex justify-end mt-6">
                        {{ $productos->links() }}
                        {{-- 
                          <nav aria-label="page-navigation">
                            <ul class="flex list-style-none">
                                <li class="page-item disabled ">
                                    <a href="#"
                                        class="relative block pointer-events-none px-3 py-1.5 mr-3 text-base text-gray-700 transition-all duration-300  rounded-md dark:text-gray-400 hover:text-gray-100 hover:bg-blue-600">Previous
                                    </a>
                                </li>
                                <li class="page-item ">
                                    <a href="#"
                                        class="relative block px-3 py-1.5 mr-3 text-base hover:text-blue-700 transition-all duration-300 hover:bg-blue-200 dark:hover:text-gray-400 dark:hover:bg-gray-700 rounded-md text-gray-100 bg-blue-400">1
                                    </a>
                                </li>
                                <li class="page-item ">
                                    <a href="#"
                                        class="relative block px-3 py-1.5 text-base text-gray-700 transition-all duration-300 dark:text-gray-400 dark:hover:bg-gray-700 hover:bg-blue-100 rounded-md mr-3  ">2
                                    </a>
                                </li>
                                <li class="page-item ">
                                    <a href="#"
                                        class="relative block px-3 py-1.5 text-base text-gray-700 transition-all duration-300 dark:text-gray-400 dark:hover:bg-gray-700 hover:bg-blue-100 rounded-md mr-3 ">3
                                    </a>
                                </li>
                                <li class="page-item ">
                                    <a href="#"
                                        class="relative block px-3 py-1.5 text-base text-gray-700 transition-all duration-300 dark:text-gray-400 dark:hover:bg-gray-700 hover:bg-blue-100 rounded-md ">Next
                                    </a>
                                </li>
                            </ul>
                          </nav>
                         --}}
                    </div>
                    <!-- pagination end -->
                </div>
            </div>
        </div>
    </section>

</div>
