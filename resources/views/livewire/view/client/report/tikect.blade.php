{{-- resources/views/livewire/view/client/report.blade.php --}}
@extends('app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-sky-50 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">


            @empty($tickets)
                <div class="text-center py-16">
                    <p class="text-slate-700 text-lg font-medium mb-4">
                        ¡Aún no tienes reservas! Reserva ahora: fácil y rápido.
                    </p>
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-xl transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Reservar ahora
                    </a>
                </div>
            @endempty



            {{-- Page Header --}}
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-sky-100 rounded-xl">
                            <svg class="w-8 h-8 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-slate-800">Mis Facturas</h1>
                            <p class="text-slate-600 mt-1">Historial de tickets y reservas</p>
                        </div>
                    </div>

                    <flux:button icon="document" href="{{ route('pdf.generar') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                        Exportar PDF
                    </flux:button>
                </div>
            </div>

            @if (Session::has('alert'))
                <script>
                    const alertData = @json(session('alert'));
                    Swal.fire({
                        icon: alertData.icon,
                        title: alertData.title,
                        text: alertData.text,
                    });
                </script>
            @endif

            {{-- Tickets List --}}
            @forelse ($tickets as $ticket)
                <div
                    class="bg-white border border-slate-200 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 sm:p-8 mb-6 group">

                    {{-- Header --}}
                    <div
                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-slate-200">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-sky-50 rounded-xl group-hover:bg-sky-100 transition-colors duration-200">
                                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-slate-800">Reserva Electrónica</h2>
                                <div class="flex items-center gap-2 mt-1 text-sm text-slate-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ $ticket->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 px-4 py-2 bg-slate-100 rounded-xl">
                            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                            </svg>
                            <span class="font-mono font-bold text-slate-800">{{ $ticket->token }}</span>
                        </div>
                    </div>

                    {{-- Flight Details --}}
                    <div class="py-6 border-b border-slate-200">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                            {{-- Origin --}}
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-sky-50 rounded-lg mt-1">
                                    <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">Origen</p>
                                    <p class="text-base font-bold text-slate-800">{{ $ticket->flight->origin->origin }}</p>
                                </div>
                            </div>

                            {{-- Destination --}}
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-sky-50 rounded-lg mt-1">
                                    <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">Destino</p>
                                    <p class="text-base font-bold text-slate-800">{{ $ticket->flight->destinie->destinie }}
                                    </p>
                                </div>
                            </div>

                            {{-- Passengers --}}
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-sky-50 rounded-lg mt-1">
                                    <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">Pasajeros
                                    </p>
                                    <p class="text-base font-bold text-slate-800">{{ $ticket->cantPasajeros + 1 }}</p>
                                </div>
                            </div>

                            {{-- Payment Method --}}
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-sky-50 rounded-lg mt-1">
                                    <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide mb-1">Método de
                                        Pago</p>
                                    <p class="text-base font-bold text-slate-800">
                                        {{ $ticket->user_payer->pays->first()->metodoPago }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Cost Breakdown --}}
                    <div class="pt-6">
                        <div class="bg-slate-50 rounded-xl p-6 space-y-3">
                            <div class="flex items-center justify-between text-slate-700">
                                <span class="font-medium">Valor por puesto:</span>
                                <span
                                    class="font-semibold">${{ number_format($ticket->flight->positionValue ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="border-t border-slate-200 pt-3 flex items-center justify-between">
                                <span class="text-lg font-bold text-slate-800">Valor Total:</span>
                                <span
                                    class="text-2xl font-bold text-sky-600">${{ number_format($ticket->user_payer->pays->first()->total ?? 0, 0, ',', '.') * ($ticket->cantPasajeros + 1) }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            @empty
                {{-- Empty State --}}
                <div class="bg-white border-2 border-dashed border-slate-300 rounded-2xl p-12 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">No hay facturas disponibles</h3>
                    <p class="text-slate-600 mb-6">Aún no has realizado ninguna compra de tickets.</p>
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Buscar Vuelos
                    </a>
                </div>
            @endforelse

        </div>
    </div>
@endsection
