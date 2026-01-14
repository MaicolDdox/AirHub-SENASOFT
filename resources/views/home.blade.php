<section class="bg-gradient-to-b from-blue-50 to-white">

    {{-- HERO PRINCIPAL --}}
    <div class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">
        <div class="flex-1 text-center md:text-left">
            <h1 class="text-5xl font-extrabold text-blue-700 mb-4 leading-tight">
                Vuela alto con <span class="text-blue-500">AirHub</span>
            </h1>
            <p class="text-gray-600 text-lg mb-6">
                Conecta con el mundo de forma rápida, segura y cómoda. 
                Disfruta de la experiencia de viajar con tecnología y atención personalizada.
            </p>

            <a href="{{ route('flights.indexWelcome') }}"
               class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition">
               Reserva tu vuelo ahora
            </a>
        </div>

        <div class="flex-1">
            <img src="{{ asset('images/hero-airplane.svg') }}" alt="Avión AirHub" class="w-full drop-shadow-lg">
        </div>
    </div>

    {{-- SECCIÓN DE BENEFICIOS --}}
    <div class="bg-white py-16 border-t">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-blue-700 mb-12">¿Por qué elegir AirHub?</h2>

            <div class="grid md:grid-cols-3 gap-10">
                <div class="p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition">
                    <h3 class="text-xl font-semibold text-blue-600 mb-2">Comodidad Premium</h3>
                    <p class="text-gray-600">
                        Disfruta asientos espaciosos, entretenimiento a bordo y atención exclusiva.
                    </p>
                </div>

                <div class="p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition">
                    <h3 class="text-xl font-semibold text-blue-600 mb-2">Reservas Flexibles</h3>
                    <p class="text-gray-600">
                        Cambia o cancela tus vuelos fácilmente, sin complicaciones ni penalizaciones ocultas.
                    </p>
                </div>

                <div class="p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition">
                    <h3 class="text-xl font-semibold text-blue-600 mb-2">Seguridad Garantizada</h3>
                    <p class="text-gray-600">
                        Operamos con altos estándares de seguridad y protocolos de confianza en cada vuelo.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- SECCIÓN DE LLAMADO A LA ACCIÓN --}}
    <div class="bg-blue-600 py-20 text-center text-white">
        <h2 class="text-3xl font-bold mb-4">Tu próximo destino te espera</h2>
        <p class="text-blue-100 mb-8">
            Explora el mundo con tarifas irresistibles y vuelos diarios a tus lugares favoritos.
        </p>
        <a href="{{ route('flights.indexWelcome') }}"
           class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-100 transition">
           Ver vuelos disponibles
        </a>
    </div>

</section>
