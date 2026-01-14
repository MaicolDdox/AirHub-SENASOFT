@extends('app')

@section('content')
    <style>
        /* LEYENDA: demos visuales */
        .seat-demo {
            width: 12px;
            height: 12px;
            border-radius: 4px;
            display: inline-block;
            border: 1px solid #cbd5e1;
        }
        .seat-demo.demo-free { background: #10b981; }
        .seat-demo.demo-busy { background: #9ca3af; }
        .seat-demo.demo-active { background: #1d4ed8; }

        /* AVION: cabina superior */
        .aircraft-cabin {
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            width: 96px;
            height: 24px;
            background: linear-gradient(to bottom, #f1f5f9, #e2e8f0);
            border-radius: 0 0 50% 50%;
            border: 1px solid #cbd5e1;
            border-top: none;
        }

        /* PRINT: sin sombras excesivas */
        @media print {
            .aircraft-wrap { box-shadow: none !important; }
            .no-print { display: none; }
        }
    </style>

    {{-- Contenedor principal con diseño corporativo --}}
    <main class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="container mx-auto max-w-7xl">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="flex flex-col lg:flex-row gap-0">

                    {{-- Panel lateral: Información del vuelo y pasajeros --}}
                    <aside class="lg:w-1/3 bg-slate-50 border-b lg:border-b-0 lg:border-r border-slate-200 p-6">
                        <div class="space-y-6">
                            {{-- Información del vuelo --}}
                            <section>
                                <h2 class="text-xl font-semibold text-slate-800 mb-3 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        role="img" aria-label="Avión">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    Información del vuelo
                                </h2>
                                <div class="bg-white rounded-lg border border-slate-200 p-4 space-y-2 text-sm">
                                    <p class="text-slate-700">
                                        <span class="font-medium text-slate-900">Ruta:</span>
                                        {{ $flight->origin->origin }} → {{ $flight->destinie->destinie }}
                                    </p>
                                    <p class="text-slate-700">
                                        <span class="font-medium text-slate-900">Fecha y hora:</span>
                                        {{ \Carbon\Carbon::parse($flight->dateHour)->format('d/m/Y H:i') }}
                                    </p>
                                    <p class="text-slate-700">
                                        <span class="font-medium text-slate-900">Capacidad:</span>
                                        {{ $flight->model_plane->capacidad }} asientos
                                    </p>
                                </div>
                            </section>

                            {{-- Lista de pasajeros --}}
                            <section>
                                <h3 class="text-lg font-semibold text-slate-800 mb-3 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" role="img" aria-label="Pasajeros">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Referente De Pago: {{ $userPayer->user->first_name }}
                                </h3>
                            </section>
                        </div>
                    </aside>


            {{-- AVION: Contenedor con forma de fuselaje --}}
            <div class="w-full md:w-2/3">
                <h2 class="text-xl font-bold text-gray-800 mb-6 text-center">Selecciona tu asiento</h2>

                <form id="seatForm" action="{{ route('positions.storePayer', $flight->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="seat_number" id="seat_number">
                    <input type="hidden" name="userPassenger" value="{{ $flight->userPassenger }}">

                    {{-- AVION: wrapper con forma de fuselaje --}}
                    <div class="aircraft-wrap relative rounded-[2rem] ring-1 ring-slate-200 shadow-lg p-4 md:p-6 bg-gradient-to-b from-white to-slate-50 mb-6">
                        {{-- AVION: cabina superior --}}
                        <div class="aircraft-cabin"></div>

                        {{-- GRID: 3-pasillo-3 usando dos grids separados --}}
                        <div class="flex justify-center items-start gap-[14px] md:gap-[18px] mx-auto max-w-[340px] md:max-w-[400px]">
                            {{-- Lado izquierdo: 3 columnas --}}
                            <div class="grid grid-cols-3 gap-x-2 gap-y-2">
                                @foreach ($positions as $index => $seat)
                                    @if (($index % 6) < 3)
                                        @php
                                            $isOccupied = $seat->estado === 'ocupado' || $seat->user_payer_id !== null;
                                        @endphp

                                        {{-- ASIENTO: estados (libre/ocupado) --}}
                                        <div
                                            class="seat {{ $isOccupied ? 'seat-busy' : 'seat-free' }} w-[2.25rem] h-[2.25rem] md:w-10 md:h-10 rounded-md text-[12px] font-semibold grid place-items-center transition-all duration-200
                                                {{ $isOccupied
                                                    ? 'bg-slate-400 text-white cursor-not-allowed opacity-85'
                                                    : 'bg-emerald-500 text-white hover:bg-emerald-600 cursor-pointer border border-emerald-600'
                                                }}"
                                            data-seat="{{ $seat->seat_number }}"
                                            @if($isOccupied)
                                                data-occupied="true"
                                                aria-disabled="true"
                                            @else
                                                role="button"
                                                tabindex="0"
                                                aria-pressed="false"
                                            @endif
                                        >
                                            {{ $seat->seat_number }}
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            {{-- PASILLO: separador visual --}}
                            <div class="w-[10px] md:w-[14px] self-stretch"></div>

                            {{-- Lado derecho: 3 columnas --}}
                            <div class="grid grid-cols-3 gap-x-2 gap-y-2">
                                @foreach ($positions as $index => $seat)
                                    @if (($index % 6) >= 3)
                                        @php
                                            $isOccupied = $seat->estado === 'ocupado' || $seat->user_payer_id !== null;
                                        @endphp

                                        {{-- ASIENTO: estados (libre/ocupado) --}}
                                        <div
                                            class="seat {{ $isOccupied ? 'seat-busy' : 'seat-free' }} w-[2.25rem] h-[2.25rem] md:w-10 md:h-10 rounded-md text-[12px] font-semibold grid place-items-center transition-all duration-200
                                                {{ $isOccupied
                                                    ? 'bg-slate-400 text-white cursor-not-allowed opacity-85'
                                                    : 'bg-emerald-500 text-white hover:bg-emerald-600 cursor-pointer border border-emerald-600'
                                                }}"
                                            data-seat="{{ $seat->seat_number }}"
                                            @if($isOccupied)
                                                data-occupied="true"
                                                aria-disabled="true"
                                            @else
                                                role="button"
                                                tabindex="0"
                                                aria-pressed="false"
                                            @endif
                                        >
                                            {{ $seat->seat_number }}
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        {{-- LEYENDA: estados de asientos --}}
                        <div class="mt-6 flex justify-center gap-4 text-xs text-slate-600">
                            <span class="inline-flex items-center gap-1.5">
                                <span class="seat-demo demo-free"></span>
                                Libre
                            </span>
                            <span class="inline-flex items-center gap-1.5">
                                <span class="seat-demo demo-busy"></span>
                                Ocupado
                            </span>
                            <span class="inline-flex items-center gap-1.5">
                                <span class="seat-demo demo-active"></span>
                                Seleccionado
                            </span>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit"
                            class="bg-sky-700 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-sky-800 transition-colors shadow-sm">
                            Confirmar asiento
                        </button>
                    </div>
                </form>

                @if (session('error'))
                    <p class="text-red-600 text-center mt-4 font-medium">{{ session('error') }}</p>
                @endif
                @if (session('success'))
                    <p class="text-emerald-600 text-center mt-4 font-medium">{{ session('success') }}</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        const seats = document.querySelectorAll('.seat');
        const inputSeat = document.getElementById('seat_number');

        seats.forEach(seat => {
            if (!seat.dataset.occupied) {
                // Click handler
                seat.addEventListener('click', () => selectSeat(seat));

                // Keyboard accessibility: Enter y Espacio
                seat.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        selectSeat(seat);
                    }
                });
            }
        });

        function selectSeat(seat) {
            // Quitar selección anterior
            seats.forEach(s => {
                s.classList.remove('bg-blue-700', 'ring-2', 'ring-blue-700', 'ring-offset-1', 'seat-active');
                if (!s.dataset.occupied) {
                    s.classList.add('bg-emerald-500', 'border-emerald-600');
                    s.setAttribute('aria-pressed', 'false');
                }
            });

            // Marcar nuevo asiento seleccionado
            seat.classList.remove('bg-emerald-500', 'border-emerald-600');
            seat.classList.add('bg-blue-700', 'ring-2', 'ring-blue-700', 'ring-offset-1', 'seat-active');
            seat.setAttribute('aria-pressed', 'true');

            // Guardar valor en input oculto
            inputSeat.value = seat.dataset.seat;
        }

        // Validación al enviar formulario
        document.getElementById('seatForm').addEventListener('submit', e => {
            if (!inputSeat.value) {
                e.preventDefault();
                alert('Por favor selecciona un asiento antes de continuar.');
            }
        });
    </script>
@endsection
