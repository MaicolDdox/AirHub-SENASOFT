<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'AirHub | Tu espacio en las alturas')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
    @stack('styles')
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body class="bg-white text-slate-800 antialiased">

    {{-- HEADER / NAVBAR --}}
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm border-b border-slate-200 shadow-sm">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <svg class="h-8 w-8 text-sky-600 transition-transform duration-200 group-hover:scale-110"
                         role="img"
                         aria-label="AirHub Logo"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                    </svg>
                    <span class="text-2xl font-bold text-sky-600">AirHub</span>
                </a>

                {{-- Navegación principal --}}
                <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-700">
                    <a href="{{ route('home') }}" class="hover:text-sky-600 transition-colors duration-200">Inicio</a>
                    <a href="{{ route('flights.indexWelcome') }}" class="hover:text-sky-600 transition-colors duration-200">Buscar vuelos</a>
                    <a href="{{ route('tickets.index') }}" class="hover:text-sky-600 transition-colors duration-200">Mis reservas</a>
                    <a href="{{ route('chat.ia') }}" class="hover:text-sky-600 transition-colors duration-200">Soporte</a>

                </nav>

                {{-- Auth / Guest --}}
                <div class="flex items-center gap-3">
                    @auth
                        <flux:dropdown position="bottom" align="end">
                            <flux:profile name="{{ Auth::user()->first_name }}" />
                            <flux:navmenu>
                                @role('admin')
                                    <flux:navmenu.item href="{{ route('dashboard') }}" icon="magnifying-glass-plus">
                                        Dashboard
                                    </flux:navmenu.item>
                                @endrole
                                <flux:navmenu.item>
                                    <form action="{{ route('logout') }}" method="POST" class="inline">
                                        @csrf
                                        <flux:navmenu.item type="submit" icon="arrow-left-start-on-rectangle">
                                            Cerrar sesión
                                        </flux:navmenu.item>
                                    </form>
                                </flux:navmenu.item>
                                <flux:menu.item  href="{{ route('flights.indexWelcome')  }}"   icon="pencil-square" kbd="⌘S">Vuelos</flux:menu.item>
                        <flux:menu.item  href="{{ route('tickets.index') }}"   icon="document-duplicate" kbd="⌘D">Reservas</flux:menu.item>
                        <flux:menu.item  href="{{ route('chat.ia') }}"   icon="user" kbd="⌘⌫">Soporte</flux:menu.item>
                            </flux:navmenu>
                        </flux:dropdown>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}"
                           class="text-sky-600 font-medium hover:text-sky-700 transition-colors duration-200">
                            Iniciar sesión
                        </a>
                        <a href="{{ route('register') }}"
                           class="bg-sky-600 text-white px-5 py-2 rounded-lg hover:bg-sky-700 transition-all duration-200 shadow-sm hover:shadow-md">
                            Registrarse
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </header>

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer id="contacto" class="bg-slate-900 text-slate-300 py-12">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                {{-- Columna 1: Logo y descripción --}}
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="h-8 w-8 text-sky-400" role="img" aria-label="AirHub Logo" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                        <span class="text-xl font-bold text-white">AirHub</span>
                    </div>
                    <p class="text-sm leading-relaxed">
                        Tu espacio en las alturas. Conectamos destinos y personas con los mejores precios del mercado.
                    </p>
                </div>

                {{-- Columna 2: Enlaces rápidos --}}
                <div>
                    <h3 class="text-white font-semibold mb-4">Enlaces rápidos</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-sky-400 transition-colors duration-200">Inicio</a></li>
                        <li><a href="{{ route('flights.indexWelcome') }}" class="hover:text-sky-400 transition-colors duration-200">Buscar vuelos</a></li>
                        <li><a href="{{ route('tickets.index') }}" class="hover:text-sky-400 transition-colors duration-200">Mis reservas</a></li>
                        <li><a href="{{ route('chat.ia.api') }}" class="hover:text-sky-400 transition-colors duration-200">Soporte</a></li>

                    </ul>
                </div>

                {{-- Columna 3: Soporte --}}
                <div>
                    <h3 class="text-white font-semibold mb-4">Soporte</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-sky-400 transition-colors duration-200">Centro de ayuda</a></li>
                        <li><a href="#" class="hover:text-sky-400 transition-colors duration-200">Términos y condiciones</a></li>
                        <li><a href="#" class="hover:text-sky-400 transition-colors duration-200">Política de privacidad</a></li>
                        <li><a href="#" class="hover:text-sky-400 transition-colors duration-200">Contacto</a></li>
                    </ul>
                </div>

                {{-- Columna 4: Redes sociales --}}
                <div>
                    <h3 class="text-white font-semibold mb-4">Síguenos</h3>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center hover:bg-sky-600 transition-colors duration-200" aria-label="Facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center hover:bg-sky-600 transition-colors duration-200" aria-label="Twitter">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center hover:bg-sky-600 transition-colors duration-200" aria-label="Instagram">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Copyright --}}
            <div class="border-t border-slate-800 pt-8 text-center text-sm text-slate-400">
                <p>© {{ date('Y') }} AirHub. Todos los derechos reservados. Tu espacio en las alturas.</p>
            </div>
        </div>
    </footer>

    @fluxScripts
    @stack('scripts')
</body>

</html>
