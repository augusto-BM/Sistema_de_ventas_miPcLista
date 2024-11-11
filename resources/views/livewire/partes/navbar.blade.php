<header
    class="flex z-50 sticky top-0 flex-wrap md:justify-start md:flex-nowrap w-full bg-white text-sm py-3 md:py-0 dark:bg-gray-800 shadow-md">
    <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8" aria-label="Global">
        <div class="relative md:flex md:items-center md:justify-between">
            <div class="flex items-center justify-between">
                <a wire:navigate
                    class="flex-none text-xl font-semibold dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    href="/" aria-label="Brand"><img class="w-40"
                        src="data:image/png;base64,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"
                        alt="Logo de la empresa"></a>
                <div class="md:hidden">
                    <button type="button"
                        class="hs-collapse-toggle flex justify-center items-center w-9 h-9 text-sm font-semibold rounded-lg border border-gray-200 text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                        data-hs-collapse="#navbar-collapse-with-animation"
                        aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
                        <svg class="hs-collapse-open:hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="6" y2="6" />
                            <line x1="3" x2="21" y1="12" y2="12" />
                            <line x1="3" x2="21" y1="18" y2="18" />
                        </svg>
                        <svg class="hs-collapse-open:block hidden flex-shrink-0 w-4 h-4"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <div id="navbar-collapse-with-animation"
                class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block">
                <div
                    class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500">
                    <div
                        class="flex flex-col gap-x-0 mt-5 divide-y divide-dashed divide-gray-200 md:flex-row md:items-center md:justify-end md:gap-x-7 md:mt-0 md:ps-7 md:divide-y-0 md:divide-solid dark:divide-gray-700">

                        <a wire:navigate
                            class="font-medium {{ request()->is('/') ? 'text-blue-600' : 'text-gray-500' }} py-3 md:py-6 dark:text-blue-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/" aria-current="page">Inicio</a>

                        <a wire:navigate
                            class="font-medium {{ request()->is('/categorias') ? 'text-blue-600' : 'text-gray-500' }} hover:text-gray-400 py-3 md:py-6 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/categorias">
                            Categorias
                        </a>

                        <a wire:navigate
                            class="font-medium {{ request()->is('/productos') ? 'text-blue-600' : 'text-gray-500' }} hover:text-gray-400 py-3 md:py-6 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/productos">
                            Productos
                        </a>

                        <a wire:navigate
                            class="font-medium flex items-center {{ request()->is('/carrito') ? 'text-blue-600' : 'text-gray-500' }} hover:text-gray-400 py-3 md:py-6 dark:text-gray-400 dark:hover:text-gray-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/carrito">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 w-5 h-5 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            <span class="mr-1">Carrito</span> <span
                                class="py-0.5 px-1.5 rounded-full text-xs font-medium bg-blue-50 border border-blue-200 text-blue-600">{{ $cuenta_total }}</span>
                        </a>

                        @guest
                            <div class="pt-3 md:pt-0">
                                <a wire:navigate
                                    class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                    href="/login">
                                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                    Iniciar Sesion
                                </a>
                            </div>
                        @endguest

                        @auth
                            <div
                                class="hs-dropdown [--strategy:static] md:[--strategy:fixed] [--adaptive:none] md:[--trigger:hover] md:py-4">
                                <button type="button"
                                    class="flex items-center w-full text-gray-500 hover:text-gray-400 font-medium dark:text-gray-400 dark:hover:text-gray-500">
                                    {{ auth()->user()->name }}
                                    <svg class="ms-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </button>

                                <div
                                    class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-48 hidden z-10 bg-white md:shadow-md rounded-lg p-2 dark:bg-gray-800 md:dark:border dark:border-gray-700 dark:divide-gray-700 before:absolute top-full md:border before:-top-5 before:start-0 before:w-full before:h-5">
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                       wire:navigate href="/mis-pedidos">
                                        Mis Pedidos
                                    </a>

                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                        href="#">
                                        Mi cuenta
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                        href="/logout">
                                        Cerrar Sesion
                                    </a>
                                </div>
                            </div>
                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
