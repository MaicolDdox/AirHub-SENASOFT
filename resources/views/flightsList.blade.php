<x-layouts.app :title="__('FlightsList')">
    <div class="space-y-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Listado de vuelos</h1>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">Gestiona rutas, estados y cupos disponibles.</p>
            </div>
            <a
                href="{{ route('flight.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-sky-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-400/60 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-zinc-950"
            >
                Crear vuelo
            </a>
        </div>

        <div class="relative overflow-hidden rounded-2xl border border-zinc-200/70 bg-white/80 shadow-sm dark:border-zinc-800 dark:bg-zinc-900/60">
            <div class="overflow-x-auto">
                <table class="min-w-[1000px] w-full divide-y divide-zinc-200 text-sm dark:divide-zinc-800">
                    <thead class="bg-zinc-50/80 text-xs uppercase tracking-wide text-zinc-500 dark:bg-zinc-900/80 dark:text-zinc-400">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left font-semibold">ID</th>
                            <th scope="col" class="px-4 py-3 text-left font-semibold">Origen</th>
                            <th scope="col" class="px-4 py-3 text-left font-semibold">Destino</th>
                            <th scope="col" class="px-4 py-3 text-left font-semibold">Aerolinea</th>
                            <th scope="col" class="px-4 py-3 text-left font-semibold">Modelo</th>
                            <th scope="col" class="px-4 py-3 text-left font-semibold">Fecha y hora</th>
                            <th scope="col" class="px-4 py-3 text-left font-semibold">Precio</th>
                            <th scope="col" class="px-4 py-3 text-left font-semibold">Cupos</th>
                            <th scope="col" class="px-4 py-3 text-left font-semibold">Estado</th>
                            <th scope="col" class="px-4 py-3 text-right font-semibold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @forelse ($flights as $flight)
                            @php
                                $isAvailable = $flight->estado === 'disponible';
                                $nextStatus = $isAvailable ? 'lleno' : 'disponible';
                                $flightDate = $flight->dateHour
                                    ? \Illuminate\Support\Carbon::parse($flight->dateHour)->format('Y-m-d H:i')
                                    : 'Sin fecha';
                            @endphp
                            <tr class="odd:bg-white even:bg-zinc-50/60 hover:bg-zinc-50/90 dark:odd:bg-zinc-900/40 dark:even:bg-zinc-900/70 dark:hover:bg-zinc-800/60">
                                <td class="px-4 py-3 font-medium text-zinc-900 dark:text-zinc-100">{{ $flight->id }}</td>
                                <td class="px-4 py-3 text-zinc-700 dark:text-zinc-200">{{ $flight->origin->origin }}</td>
                                <td class="px-4 py-3 text-zinc-700 dark:text-zinc-200">{{ $flight->destinie->destinie }}</td>
                                <td class="px-4 py-3 text-zinc-700 dark:text-zinc-200">{{ $flight->airline->airline }}</td>
                                <td class="px-4 py-3 text-zinc-700 dark:text-zinc-200">{{ $flight->model_plane->marca }}</td>
                                <td class="px-4 py-3 text-zinc-700 dark:text-zinc-200">{{ $flightDate }}</td>
                                <td class="px-4 py-3 text-zinc-700 dark:text-zinc-200">
                                    ${{ number_format($flight->positionValue ?? 0, 0, '.', ',') }}
                                </td>
                                <td class="px-4 py-3 text-zinc-700 dark:text-zinc-200">{{ $flight->cantCupos }}</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold ring-1 ring-inset {{ $isAvailable ? 'bg-emerald-100 text-emerald-700 ring-emerald-200/70 dark:bg-emerald-500/10 dark:text-emerald-300 dark:ring-emerald-500/30' : 'bg-rose-100 text-rose-700 ring-rose-200/70 dark:bg-rose-500/10 dark:text-rose-300 dark:ring-rose-500/30' }}"
                                    >
                                        {{ $isAvailable ? 'Disponible' : 'Lleno' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <form action="{{ route('change.status') }}" method="POST" class="inline-flex">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="vuelo" class="hidden" value="{{ $flight->id }}">
                                        <button
                                            type="submit"
                                            class="inline-flex items-center justify-center rounded-lg border border-zinc-200 bg-white px-3 py-1.5 text-xs font-semibold text-zinc-700 shadow-sm transition hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-sky-400/60 focus:ring-offset-2 focus:ring-offset-white dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-200 dark:hover:bg-zinc-800 dark:focus:ring-offset-zinc-950"
                                            aria-label="Cambiar estado del vuelo {{ $flight->id }} a {{ $nextStatus }}"
                                        >
                                            Cambiar a {{ $nextStatus }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-6 py-10 text-center">
                                    <div class="mx-auto flex max-w-sm flex-col items-center gap-2 text-sm text-zinc-500 dark:text-zinc-400">
                                        <span class="text-base font-semibold text-zinc-700 dark:text-zinc-200">Sin registros</span>
                                        <span>No hay vuelos disponibles en este momento.</span>
                                        <a
                                            href="{{ route('flight.create') }}"
                                            class="mt-2 inline-flex items-center rounded-lg border border-zinc-200 bg-white px-3 py-1.5 text-sm font-semibold text-zinc-700 shadow-sm hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-200 dark:hover:bg-zinc-800"
                                        >
                                            Crear primer vuelo
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div
                class="pointer-events-none absolute inset-0 hidden items-center justify-center bg-white/70 text-sm font-medium text-zinc-600 backdrop-blur-sm dark:bg-zinc-900/70 dark:text-zinc-300"
                wire:loading.class.remove="hidden"
            >
                Cargando vuelos...
            </div>
        </div>
    </div>
</x-layouts.app>
