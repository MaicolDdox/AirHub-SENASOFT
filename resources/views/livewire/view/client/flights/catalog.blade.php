{{-- resources/views/catalogoFlights.blade.php --}}
    <div class="space-y-6">
    {{-- FILTROS MEJORADOS --}}
    <div class="bg-white shadow-md rounded-xl p-6 border border-slate-200">
        <div class="flex flex-col lg:flex-row gap-4 lg:items-end">
            {{-- Filtros --}}
            <div class="flex-1 grid grid-cols-1 sm:grid-cols-3 gap-4">
                {{-- Filtro de origen --}}
                <div>
                    <label for="originFilter" class="block text-sm font-medium text-slate-700 mb-2">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            Lugar de origen
                        </span>
                    </label>
                    <select id="originFilter" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200 bg-white hover:border-slate-400">
                        <option disabled selected>Seleccionar origen</option>
                        @foreach ($origenes as $origen)
                            <option value="{{ $origen->origin }}">{{ $origen->origin }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Filtro de destino --}}
                <div>
                    <label for="destinyFilter" class="block text-sm font-medium text-slate-700 mb-2">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Lugar de destino
                        </span>
                    </label>
                    <select id="destinyFilter" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200 bg-white hover:border-slate-400">
                        <option disabled selected>Seleccionar destino</option>
                        @foreach ($destinos as $destini)
                            <option value="{{ $destini->destinie }}">{{ $destini->destinie }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Filtro de fecha --}}
                <div>
                    <label for="filterDate" class="block text-sm font-medium text-slate-700 mb-2">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Fecha de vuelo
                        </span>
                    </label>
                    <input type="date" id="filterDate" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200 hover:border-slate-400" />
                </div>
            </div>

            {{-- Botón limpiar filtros --}}
            <div>
                <button id="clearFilters" class="w-full lg:w-auto bg-slate-600 hover:bg-slate-700 text-white font-medium px-6 py-2.5 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Limpiar filtros
                </button>
            </div>
        </div>
    </div>

    {{-- CATÁLOGO DE VUELOS --}}
    <div id="flightsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($flights as $flight)
            @php
                $dateOnly = \Carbon\Carbon::parse($flight->dateHour)->format('Y-m-d');
                $formattedDate = \Carbon\Carbon::parse($flight->dateHour)->format('d M Y');
                $formattedTime = \Carbon\Carbon::parse($flight->dateHour)->format('H:i');
            @endphp
            <div class="flightCard bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-200 group"
                data-origin="{{ strtolower($flight->origin->origin) }}"
                data-destiny="{{ strtolower($flight->destinie->destinie) }}" 
                data-date="{{ $dateOnly }}">
                
                {{-- Header de la tarjeta con gradiente --}}
                <div class="bg-gradient-to-r from-sky-500 to-blue-600 p-5 text-white">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            <span class="text-sm font-medium opacity-90">{{ $flight->airline->airline }}</span>
                        </div>
                        <div class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold">
                            {{ $flight->model_plane->capacidad }} asientos
                        </div>
                    </div>
                    
                    {{-- Ruta del vuelo --}}
                    <div class="flex items-center justify-between">
                        <div class="text-center">
                            <div class="text-2xl font-bold">{{ substr($flight->origin->origin, 0, 3) }}</div>
                            <div class="text-xs opacity-80">{{ $flight->origin->origin }}</div>
                        </div>
                        <div class="flex-1 px-4">
                            <div class="flex items-center justify-center gap-2">
                                <div class="h-px bg-white/40 flex-1"></div>
                                <svg class="w-5 h-5 opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                                <div class="h-px bg-white/40 flex-1"></div>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold">{{ substr($flight->destinie->destinie, 0, 3) }}</div>
                            <div class="text-xs opacity-80">{{ $flight->destinie->destinie }}</div>
                        </div>
                    </div>
                </div>

                {{-- Detalles del vuelo --}}
                <div class="p-5 space-y-3">
                    {{-- Modelo de avión --}}
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span><strong>Modelo:</strong> {{ $flight->model_plane->marca }}</span>
                    </div>

                    {{-- Fecha y hora --}}
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span><strong>Salida:</strong> {{ $formattedDate }} a las {{ $formattedTime }}</span>
                    </div>

                    {{-- Precio --}}
                    <div class="pt-3 border-t border-slate-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-xs text-slate-500 mb-1">Precio por asiento</div>
                                <div class="text-2xl font-bold text-sky-600">
                                    ${{ number_format($flight->positionValue, 0, ',', '.') }}
                                </div>
                            </div>
                            <a href="{{ route('flights.edit', $flight->id) }}" 
                               class="inline-flex items-center gap-2 bg-sky-600 hover:bg-sky-700 text-white font-semibold px-6 py-3 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg group-hover:scale-105">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Comprar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Mensaje cuando no hay vuelos --}}
    @if ($flights->isEmpty())
        <div class="bg-white rounded-xl shadow-md p-12 text-center border border-slate-200">
            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <h3 class="text-xl font-semibold text-slate-900 mb-2">No hay vuelos disponibles</h3>
            <p class="text-slate-600">No se encontraron vuelos que coincidan con tus criterios de búsqueda.</p>
        </div>
    @endif
</div>

{{-- Script para filtros (mantener funcionalidad existente) --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const originFilter = document.getElementById('originFilter');
        const destinyFilter = document.getElementById('destinyFilter');
        const dateFilter = document.getElementById('filterDate');
        const clearButton = document.getElementById('clearFilters');
        const flightCards = document.querySelectorAll('.flightCard');

        function filterFlights() {
            const selectedOrigin = originFilter.value.toLowerCase();
            const selectedDestiny = destinyFilter.value.toLowerCase();
            const selectedDate = dateFilter.value;

            flightCards.forEach(card => {
                const cardOrigin = card.dataset.origin;
                const cardDestiny = card.dataset.destiny;
                const cardDate = card.dataset.date;

                const matchOrigin = !selectedOrigin || selectedOrigin === 'seleccionar origen' || cardOrigin === selectedOrigin;
                const matchDestiny = !selectedDestiny || selectedDestiny === 'seleccionar destino' || cardDestiny === selectedDestiny;
                const matchDate = !selectedDate || cardDate === selectedDate;

                if (matchOrigin && matchDestiny && matchDate) {
                    card.style.display = 'block';
                    card.classList.add('animate-fade-in');
                } else {
                    card.style.display = 'none';
                }
            });
        }

        originFilter.addEventListener('change', filterFlights);
        destinyFilter.addEventListener('change', filterFlights);
        dateFilter.addEventListener('change', filterFlights);

        clearButton.addEventListener('click', function() {
            originFilter.selectedIndex = 0;
            destinyFilter.selectedIndex = 0;
            dateFilter.value = '';
            flightCards.forEach(card => {
                card.style.display = 'block';
            });
        });
    });
</script>
@endpush

