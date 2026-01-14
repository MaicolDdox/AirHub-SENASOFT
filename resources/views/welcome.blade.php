@extends('app')

@section('title', 'AirHub | Tu espacio en las alturas')

@section('content')

    {{-- HERO SECTION --}}
    <section class="relative bg-gradient-to-br from-sky-50 via-white to-slate-50 overflow-hidden">
        {{-- Nubes decorativas SVG --}}
        <div class="absolute inset-0 pointer-events-none opacity-20" aria-hidden="true">
            <svg class="absolute top-20 left-10 w-32 h-32 text-sky-200 animate-pulse" style="animation-duration: 4s;"
                fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M6.5 20q-2.28 0-3.89-1.57Q1 16.85 1 14.58q0-1.95 1.17-3.48 1.18-1.53 3.08-1.95.63-2.3 2.5-3.72Q9.63 4 12 4q2.93 0 4.96 2.04Q19 8.07 19 11q1.73.2 2.86 1.5 1.14 1.28 1.14 3 0 1.88-1.31 3.19T18.5 20z" />
            </svg>
            <svg class="absolute top-40 right-20 w-24 h-24 text-sky-100 animate-pulse"
                style="animation-duration: 5s; animation-delay: 1s;" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M6.5 20q-2.28 0-3.89-1.57Q1 16.85 1 14.58q0-1.95 1.17-3.48 1.18-1.53 3.08-1.95.63-2.3 2.5-3.72Q9.63 4 12 4q2.93 0 4.96 2.04Q19 8.07 19 11q1.73.2 2.86 1.5 1.14 1.28 1.14 3 0 1.88-1.31 3.19T18.5 20z" />
            </svg>
        </div>

        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20 sm:py-28 lg:py-36 relative">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-slate-900 mb-6 leading-tight">
                    Tu próximo destino está a un
                    <span class="text-sky-600">clic de distancia</span>
                </h1>
                <p class="text-lg sm:text-xl text-slate-600 mb-8 leading-relaxed max-w-2xl mx-auto">
                    Descubre las mejores ofertas en vuelos nacionales e internacionales.
                    Viaja con confianza, seguridad y los mejores precios del mercado.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('flights.indexWelcome') }}"
                        class="inline-flex items-center gap-2 bg-sky-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-sky-700 transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Buscar vuelos ahora
                    </a>
                    <a href="#beneficios"
                        class="inline-flex items-center gap-2 bg-white text-slate-700 px-8 py-4 rounded-lg font-semibold hover:bg-slate-50 transition-all duration-200 shadow-md hover:shadow-lg border border-slate-200">
                        Ver beneficios
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ModalChatBot --}}
    <flux:modal.trigger name="edit-profile">
        <flux:button>CHAT BOT 🤖</flux:button>
    </flux:modal.trigger>

    <flux:modal name="edit-profile" variant="flyout">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Chat bot TicketBot</flux:heading>
                <flux:text class="mt-2">Hazme cualquier pregunta sobre el sistema</flux:text>
            </div>

            <div id="chatBox" class="h-80 overflow-y-auto border rounded p-3 text-sm mb-3 bg-slate-50">
                <p>
                    <div class="text-slate-500">Pregúntame algo sobre la página...</div>
                </p>
            </div>

            <form id="chatForm" class="flex gap-2">
                @csrf
                <input id="message" name="message" class="flex-1 border rounded px-3 py-2"
                    placeholder="Escribe tu mensaje..." autocomplete="off">

                <div class="flex">
                    <flux:spacer />

                    <button class="bg-sky-600 text-white px-4 rounded hover:bg-sky-700">Enviar</button>
                </div>
            </form>
        </div>
        <script>
            const chatBox = document.getElementById('chatBox');
            const form = document.getElementById('chatForm');
            const input = document.getElementById('message');

            function addMsg(role, text) {
                const div = document.createElement('div');
                div.className = 'mb-2 ' + (role === 'user' ? 'text-right' : 'text-left');
                div.innerHTML =
                    `<div class="${role==='user'?'bg-sky-600 text-white':'bg-slate-200'} inline-block px-3 py-2 rounded">${text}</div>`;
                chatBox.appendChild(div);
                chatBox.scrollTop = chatBox.scrollHeight;
            }

            form.addEventListener('submit', async e => {
                e.preventDefault();
                const msg = input.value.trim();
                if (!msg) return;
                addMsg('user', msg);
                input.value = '';

                const thinking = document.createElement('div');
                thinking.textContent = '🤔 pensando...';
                chatBox.appendChild(thinking);

                const res = await fetch(`{{ route('chat.ia.api') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                    },
                    body: JSON.stringify({
                        message: msg
                    })
                });
                const data = await res.json();
                thinking.remove();
                addMsg('bot', data.reply);
            });
        </script>
    </flux:modal>

    {{-- BENEFICIOS --}}
    <section id="beneficios" class="py-16 sm:py-20 bg-slate-50">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">¿Por qué elegir AirHub?</h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                    Ofrecemos la mejor experiencia de reserva con beneficios exclusivos para nuestros clientes
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Beneficio 1: Mejores precios --}}
                <div
                    class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-200 border border-slate-200">
                    <div class="w-12 h-12 bg-sky-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-2">Mejores precios</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Garantizamos las tarifas más competitivas del mercado con ofertas exclusivas
                    </p>
                </div>

                {{-- Beneficio 2: Seguridad --}}
                <div
                    class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-200 border border-slate-200">
                    <div class="w-12 h-12 bg-sky-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-2">100% seguro</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Tus datos y pagos están protegidos con la más alta tecnología de encriptación
                    </p>
                </div>

                {{-- Beneficio 3: Soporte 24/7 --}}
                <div
                    class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-200 border border-slate-200">
                    <div class="w-12 h-12 bg-sky-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-2">Soporte 24/7</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Nuestro equipo está disponible en todo momento para ayudarte con tus reservas
                    </p>
                </div>

                {{-- Beneficio 4: Flexibilidad --}}
                <div
                    class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-200 border border-slate-200">
                    <div class="w-12 h-12 bg-sky-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-2">Cambios flexibles</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Modifica tus reservas fácilmente sin complicaciones ni cargos ocultos
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ESTADÍSTICAS / CONFIANZA --}}
    <section class="py-16 sm:py-20 bg-white">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">Números que nos respaldan</h2>
                <p class="text-lg text-slate-600">Miles de viajeros confían en nosotros cada día</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 sm:gap-12">
                <div class="text-center">
                    <div class="text-5xl sm:text-6xl font-bold text-sky-600 mb-2">500K+</div>
                    <div class="text-lg text-slate-600 font-medium">Clientes satisfechos</div>
                </div>
                <div class="text-center">
                    <div class="text-5xl sm:text-6xl font-bold text-sky-600 mb-2">150+</div>
                    <div class="text-lg text-slate-600 font-medium">Destinos disponibles</div>
                </div>
                <div class="text-center">
                    <div class="text-5xl sm:text-6xl font-bold text-sky-600 mb-2">98%</div>
                    <div class="text-lg text-slate-600 font-medium">Puntualidad garantizada</div>
                </div>
            </div>
        </div>
    </section>

    {{-- LOGOS DE CONFIANZA --}}
    <section class="py-12 bg-slate-50 border-y border-slate-200">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm font-medium text-slate-500 mb-8 uppercase tracking-wide">
                Trabajamos con las mejores aerolíneas
            </p>
            <div class="flex flex-wrap justify-center items-center gap-8 sm:gap-12 opacity-60 grayscale">
                {{-- Placeholders para logos de aerolíneas --}}
                <div class="text-2xl font-bold text-slate-400">Avianca</div>
                <div class="text-2xl font-bold text-slate-400">LATAM</div>
                <div class="text-2xl font-bold text-slate-400">Copa Airlines</div>
                <div class="text-2xl font-bold text-slate-400">Aeromexico</div>
                <div class="text-2xl font-bold text-slate-400">Iberia</div>
            </div>
        </div>
    </section>

    {{-- TESTIMONIOS --}}
    <section class="py-16 sm:py-20 bg-white">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">Lo que dicen nuestros clientes</h2>
                <p class="text-lg text-slate-600">Experiencias reales de viajeros como tú</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Testimonio 1 --}}
                <div class="bg-slate-50 rounded-xl p-6 border border-slate-200">
                    <div class="flex items-center gap-1 mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-slate-700 mb-4 leading-relaxed">
                        "Excelente servicio. Encontré los mejores precios y el proceso de reserva fue súper rápido.
                        Definitivamente volveré a usar AirHub."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-sky-100 rounded-full flex items-center justify-center">
                            <span class="text-sky-600 font-semibold">MC</span>
                        </div>
                        <div>
                            <div class="font-semibold text-slate-900">María Contreras</div>
                            <div class="text-sm text-slate-500">Bogotá, Colombia</div>
                        </div>
                    </div>
                </div>

                {{-- Testimonio 2 --}}
                <div class="bg-slate-50 rounded-xl p-6 border border-slate-200">
                    <div class="flex items-center gap-1 mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-slate-700 mb-4 leading-relaxed">
                        "La atención al cliente es increíble. Tuve un problema con mi reserva y lo resolvieron en minutos.
                        Muy recomendado."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-sky-100 rounded-full flex items-center justify-center">
                            <span class="text-sky-600 font-semibold">JR</span>
                        </div>
                        <div>
                            <div class="font-semibold text-slate-900">Juan Rodríguez</div>
                            <div class="text-sm text-slate-500">Ciudad de México, México</div>
                        </div>
                    </div>
                </div>

                {{-- Testimonio 3 --}}
                <div class="bg-slate-50 rounded-xl p-6 border border-slate-200">
                    <div class="flex items-center gap-1 mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-slate-700 mb-4 leading-relaxed">
                        "Plataforma muy intuitiva y fácil de usar. He reservado varios vuelos y siempre ha sido una
                        experiencia perfecta."
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-sky-100 rounded-full flex items-center justify-center">
                            <span class="text-sky-600 font-semibold">AS</span>
                        </div>
                        <div>
                            <div class="font-semibold text-slate-900">Ana Silva</div>
                            <div class="text-sm text-slate-500">Lima, Perú</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA FINAL --}}
    <section class="py-16 sm:py-20 bg-gradient-to-br from-sky-600 to-sky-700 text-white">
        <div class="container mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-bold mb-4">¿Listo para tu próxima aventura?</h2>
            <p class="text-lg sm:text-xl text-sky-100 mb-8 leading-relaxed">
                Únete a miles de viajeros que ya confían en AirHub para sus vuelos
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('flights.indexWelcome') }}"
                    class="inline-flex items-center gap-2 bg-white text-sky-600 px-8 py-4 rounded-lg font-semibold hover:bg-sky-50 transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                    </svg>
                    Reservar ahora
                </a>
                @guest
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center gap-2 bg-sky-800 text-white px-8 py-4 rounded-lg font-semibold hover:bg-sky-900 transition-all duration-200 shadow-lg hover:shadow-xl border border-sky-500">
                        Crear cuenta gratis
                    </a>
                @endguest
            </div>
        </div>
    </section>
@endsection
