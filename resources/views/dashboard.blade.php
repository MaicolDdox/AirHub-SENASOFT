<x-layouts.app :title="__('Dashboard')">
    @php
        $totalFlights = \App\Models\Flight::count();
        $availableFlights = \App\Models\Flight::where('estado', 'disponible')->count();
        $totalPlanes = \App\Models\ModelPlane::count();
        $totalTickets = \App\Models\Ticket::count();

        $months = collect(range(5, 0))->map(fn ($offset) => now()->subMonths($offset)->format('Y-m'));
        $monthLabels = $months->map(fn ($month) => \Illuminate\Support\Carbon::createFromFormat('Y-m', $month)->format('M Y'));
        $groupedByMonth = \App\Models\Flight::whereNotNull('dateHour')->get()
            ->groupBy(fn ($flight) => \Illuminate\Support\Carbon::parse($flight->dateHour)->format('Y-m'))
            ->map->count();
        $monthSeries = $months->map(fn ($month) => $groupedByMonth->get($month, 0))->values();

        $statusCounts = \App\Models\Flight::select('estado')->get()
            ->groupBy(fn ($flight) => $flight->estado ?: 'sin estado')
            ->map->count();
        $statusEmpty = $statusCounts->isEmpty();
        $statusLabels = $statusEmpty ? collect(['Sin datos']) : $statusCounts->keys()->map(fn ($label) => ucfirst($label))->values();
        $statusSeries = $statusEmpty ? collect([1]) : $statusCounts->values()->values();
    @endphp

    <div
        class="space-y-6"
        data-dashboard
        data-month-labels='@json($monthLabels)'
        data-month-series='@json($monthSeries)'
        data-status-labels='@json($statusLabels)'
        data-status-series='@json($statusSeries)'
        data-status-empty="{{ $statusEmpty ? '1' : '0' }}"
    >
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Dashboard</h1>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">Vista general de vuelos, flota y reservas.</p>
        </div>

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl border border-zinc-200/70 bg-white/80 p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900/60">
                <p class="text-xs uppercase tracking-wide text-zinc-500 dark:text-zinc-400">Total vuelos</p>
                <p class="mt-2 text-2xl font-semibold text-zinc-900 dark:text-zinc-100">{{ $totalFlights }}</p>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Disponibles: {{ $availableFlights }}</p>
            </div>
            <div class="rounded-2xl border border-zinc-200/70 bg-white/80 p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900/60">
                <p class="text-xs uppercase tracking-wide text-zinc-500 dark:text-zinc-400">Modelos de avion</p>
                <p class="mt-2 text-2xl font-semibold text-zinc-900 dark:text-zinc-100">{{ $totalPlanes }}</p>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Flota activa registrada.</p>
            </div>
            <div class="rounded-2xl border border-zinc-200/70 bg-white/80 p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900/60">
                <p class="text-xs uppercase tracking-wide text-zinc-500 dark:text-zinc-400">Reservas</p>
                <p class="mt-2 text-2xl font-semibold text-zinc-900 dark:text-zinc-100">{{ $totalTickets }}</p>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Tickets generados.</p>
            </div>
            <div class="rounded-2xl border border-zinc-200/70 bg-white/80 p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900/60">
                <p class="text-xs uppercase tracking-wide text-zinc-500 dark:text-zinc-400">Aerolineas</p>
                <p class="mt-2 text-2xl font-semibold text-zinc-900 dark:text-zinc-100">{{ \App\Models\Airline::count() }}</p>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Operadores disponibles.</p>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <section class="lg:col-span-2 rounded-2xl border border-zinc-200/70 bg-white/80 shadow-sm dark:border-zinc-800 dark:bg-zinc-900/60">
                <div class="flex items-center justify-between border-b border-zinc-200/70 px-6 py-4 dark:border-zinc-800">
                    <div>
                        <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">Vuelos por mes</h2>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Ultimos 6 meses.</p>
                    </div>
                </div>
                <div class="p-6">
                    <div id="chart-flights" class="h-[280px]" wire:ignore aria-label="Grafica de vuelos por mes"></div>
                </div>
            </section>

            <section class="rounded-2xl border border-zinc-200/70 bg-white/80 shadow-sm dark:border-zinc-800 dark:bg-zinc-900/60">
                <div class="border-b border-zinc-200/70 px-6 py-4 dark:border-zinc-800">
                    <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">Estado de vuelos</h2>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Distribucion actual.</p>
                </div>
                <div class="p-6">
                    <div id="chart-status" class="h-[280px]" wire:ignore aria-label="Grafica de estado de vuelos"></div>
                    @if ($statusEmpty)
                        <p class="mt-4 text-xs text-zinc-500 dark:text-zinc-400">No hay datos suficientes para mostrar estados reales.</p>
                    @endif
                </div>
            </section>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts" data-navigate-once></script>
    @endpush
</x-layouts.app>
