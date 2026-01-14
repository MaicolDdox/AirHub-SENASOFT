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
    .seat-demo.demo-free  { background: #10b981; }
    .seat-demo.demo-busy  { background: #9ca3af; }
    .seat-demo.demo-active{ background: #1d4ed8; }

    /* AVION: cabina superior (bisel delantero) */
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
                                          d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
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
                                <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     role="img" aria-label="Pasajeros">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Pasajeros ({{ $passengers->count() }})
                            </h3>
                            <ul class="bg-white rounded-lg border border-slate-200 divide-y divide-slate-200">
                                @foreach ($passengers as $index => $passenger)
                                    <li class="px-4 py-3 text-sm text-slate-700 flex items-center gap-2">
                                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-sky-100 text-sky-700 text-xs font-medium">
                                            {{ $index + 1 }}
                                        </span>
                                        {{ $passenger->first_name }} {{ $passenger->first_surname }}
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    </div>
                </aside>

                {{-- AVION: Contenedor con forma de fuselaje --}}
                <div class="w-full md:w-2/3">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 text-center">Selecciona tu asiento</h2>

                    {{-- Importante: este form ID debe coincidir con el JS --}}
                    <form id="passengerForm" action="{{ route('positions.storePassengers', $flight->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Compatibilidad: si tu back lo usa en otra vista, lo dejamos (no lo llenamos aquí) --}}
                        <input type="hidden" name="seat_number" id="seat_number">

                        {{-- Uno por pasajero, en mismo orden que $passengers --}}
                        @for ($i = 0; $i < $passengers->count(); $i++)
                            <input type="hidden" name="passenger_seats[]" id="passenger_seat_{{ $i }}">
                        @endfor

                        {{-- AVION: wrapper con forma de fuselaje --}}
                        <div class="aircraft-wrap relative rounded-[2rem] ring-1 ring-slate-200 shadow-lg p-4 md:p-6 bg-gradient-to-b from-white to-slate-50 mb-6">
                            {{-- AVION: cabina superior --}}
                            <div class="aircraft-cabin"></div>

                            {{-- GRID: 3-pasillo-3 usando dos grids sincronizados --}}
                            <div class="flex justify-center items-start gap-[14px] md:gap-[18px] mx-auto max-w-[340px] md:max-w-[400px]">
                                {{-- Lado izquierdo: 3 columnas --}}
                                <div class="grid grid-cols-3 gap-x-2 gap-y-2">
                                    @foreach ($positions as $index => $seat)
                                        @if ($index % 6 < 3)
                                            @php
                                                $isOccupied = $seat->estado === 'ocupado' || $seat->user_payer_id !== null;
                                            @endphp

                                            {{-- ASIENTO: estados (libre/ocupado) --}}
                                            <div
                                                class="seat {{ $isOccupied ? 'seat-busy' : 'seat-free' }}
                                                    w-[2.25rem] h-[2.25rem] md:w-10 md:h-10 rounded-md text-[12px] font-semibold grid place-items-center transition-all duration-200
                                                    {{ $isOccupied
                                                        ? 'bg-slate-400 text-white cursor-not-allowed opacity-85'
                                                        : 'bg-emerald-500 text-white hover:bg-emerald-600 cursor-pointer border border-emerald-600' }}"
                                                data-seat="{{ $seat->seat_number }}"
                                                @if ($isOccupied)
                                                    data-occupied="true" aria-disabled="true" tabindex="-1" disabled
                                                @else
                                                    role="button" tabindex="0" aria-pressed="false"
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
                                        @if ($index % 6 >= 3)
                                            @php
                                                $isOccupied = $seat->estado === 'ocupado' || $seat->user_payer_id !== null;
                                            @endphp

                                            {{-- ASIENTO: estados (libre/ocupado) --}}
                                            <div
                                                class="seat {{ $isOccupied ? 'seat-busy' : 'seat-free' }}
                                                    w-[2.25rem] h-[2.25rem] md:w-10 md:h-10 rounded-md text-[12px] font-semibold grid place-items-center transition-all duration-200
                                                    {{ $isOccupied
                                                        ? 'bg-slate-400 text-white cursor-not-allowed opacity-85'
                                                        : 'bg-emerald-500 text-white hover:bg-emerald-600 cursor-pointer border border-emerald-600' }}"
                                                data-seat="{{ $seat->seat_number }}"
                                                @if ($isOccupied)
                                                    data-occupied="true" aria-disabled="true" tabindex="-1" disabled
                                                @else
                                                    role="button" tabindex="0" aria-pressed="false"
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
    </div>
</main>

<script>
    // Solo asientos NO ocupados
    const seats = document.querySelectorAll('.seat:not([data-occupied="true"])');
    const passengerCount = {{ $passengers->count() }};
    let selectedSeats = [];

    seats.forEach(seat => {
        // Click
        seat.addEventListener('click', () => toggleSeat(seat));
        // Teclado (Enter/Espacio)
        seat.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggleSeat(seat);
            }
        });
    });

    function toggleSeat(seat) {
        const seatNumber = seat.dataset.seat;

        if (selectedSeats.includes(seatNumber)) {
            // Deseleccionar
            selectedSeats = selectedSeats.filter(s => s !== seatNumber);
            seat.classList.remove('bg-yellow-400', 'border-yellow-500');
            seat.classList.add('bg-emerald-500', 'hover:bg-emerald-600', 'border-emerald-600');
            seat.setAttribute('aria-pressed', 'false');
        } else {
            // Límite: uno por pasajero
            if (selectedSeats.length >= passengerCount) {
                alert('Ya seleccionaste todos los asientos de tus pasajeros.');
                return;
            }
            // Seleccionar
            selectedSeats.push(seatNumber);
            seat.classList.remove('bg-emerald-500', 'hover:bg-emerald-600', 'border-emerald-600');
            seat.classList.add('bg-yellow-400', 'border-yellow-500');
            seat.setAttribute('aria-pressed', 'true');
        }

        // Actualiza inputs ocultos
        for (let i = 0; i < passengerCount; i++) {
            const input = document.getElementById('passenger_seat_' + i);
            if (input) input.value = selectedSeats[i] || '';
        }
    }

    // Validación de envío
    document.getElementById('passengerForm').addEventListener('submit', e => {
        if (selectedSeats.length < passengerCount) {
            e.preventDefault();
            alert('Debes seleccionar un asiento para cada pasajero.');
        }
    });
</script>
@endsection
