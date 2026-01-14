<x-layouts.app :title="__('Crear vuelo')">
    @php
        $fieldBase = 'mt-1 w-full rounded-lg border bg-white px-3 py-2 text-sm text-zinc-900 shadow-sm focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100 dark:focus:border-sky-400 dark:focus:ring-sky-400/20';
    @endphp

    <div class="max-w-4xl space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Crear vuelo</h1>
            <p class="text-sm text-zinc-600 dark:text-zinc-400">Completa la informacion principal del vuelo y su disponibilidad.</p>
        </div>

        <form action="{{ route('flight.store') }}" method="POST" class="space-y-6">
            @csrf

            <section class="rounded-2xl border border-zinc-200/70 bg-white/80 shadow-sm dark:border-zinc-800 dark:bg-zinc-900/60">
                <div class="border-b border-zinc-200/70 px-6 py-4 dark:border-zinc-800">
                    <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">Ruta y aeronave</h2>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Define origen, destino y la aeronave asignada.</p>
                </div>
                <div class="grid gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label for="origen" class="text-sm font-medium text-zinc-700 dark:text-zinc-200">Origen</label>
                        <select
                            id="origen"
                            name="origen"
                            required
                            @class([$fieldBase, 'border-rose-500 ring-1 ring-rose-500/30 dark:border-rose-400' => $errors->has('origen')])
                        >
                            <option value="" disabled @selected(!old('origen'))>Selecciona un origen</option>
                            @foreach ($origenes as $origen)
                                <option value="{{ $origen->id }}" @selected(old('origen') == $origen->id)>
                                    {{ $origen->origin }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Ciudad o aeropuerto de salida.</p>
                        @error('origen')
                            <p class="mt-1 text-sm text-rose-600 dark:text-rose-400" role="alert">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="destino" class="text-sm font-medium text-zinc-700 dark:text-zinc-200">Destino</label>
                        <select
                            id="destino"
                            name="destino"
                            required
                            @class([$fieldBase, 'border-rose-500 ring-1 ring-rose-500/30 dark:border-rose-400' => $errors->has('destino')])
                        >
                            <option value="" disabled @selected(!old('destino'))>Selecciona un destino</option>
                            @foreach ($destinos as $destino)
                                <option value="{{ $destino->id }}" @selected(old('destino') == $destino->id)>
                                    {{ $destino->destinie }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Ciudad o aeropuerto de llegada.</p>
                        @error('destino')
                            <p class="mt-1 text-sm text-rose-600 dark:text-rose-400" role="alert">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="aerolinea" class="text-sm font-medium text-zinc-700 dark:text-zinc-200">Aerolinea</label>
                        <select
                            id="aerolinea"
                            name="aerolinea"
                            required
                            @class([$fieldBase, 'border-rose-500 ring-1 ring-rose-500/30 dark:border-rose-400' => $errors->has('aerolinea')])
                        >
                            <option value="" disabled @selected(!old('aerolinea'))>Selecciona una aerolinea</option>
                            @foreach ($aerolineas as $aerolinea)
                                <option value="{{ $aerolinea->id }}" @selected(old('aerolinea') == $aerolinea->id)>
                                    {{ $aerolinea->airline }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Operador responsable del vuelo.</p>
                        @error('aerolinea')
                            <p class="mt-1 text-sm text-rose-600 dark:text-rose-400" role="alert">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="modelo" class="text-sm font-medium text-zinc-700 dark:text-zinc-200">Modelo de avion</label>
                        <select
                            id="modelo"
                            name="modelo"
                            required
                            @class([$fieldBase, 'border-rose-500 ring-1 ring-rose-500/30 dark:border-rose-400' => $errors->has('modelo')])
                        >
                            <option value="" disabled @selected(!old('modelo'))>Selecciona un modelo</option>
                            @foreach ($modelos as $modelo)
                                <option value="{{ $modelo->id }}" @selected(old('modelo') == $modelo->id)>
                                    {{ $modelo->marca }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Modelo asignado para este vuelo.</p>
                        @error('modelo')
                            <p class="mt-1 text-sm text-rose-600 dark:text-rose-400" role="alert">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            <section class="rounded-2xl border border-zinc-200/70 bg-white/80 shadow-sm dark:border-zinc-800 dark:bg-zinc-900/60">
                <div class="border-b border-zinc-200/70 px-6 py-4 dark:border-zinc-800">
                    <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">Precio y horario</h2>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Define la tarifa base y la fecha de salida.</p>
                </div>
                <div class="grid gap-5 p-6 md:grid-cols-2">
                    <div>
                        <label for="precio" class="text-sm font-medium text-zinc-700 dark:text-zinc-200">Precio por asiento</label>
                        <input
                            id="precio"
                            type="number"
                            name="precio"
                            min="0"
                            step="0.01"
                            value="{{ old('precio') }}"
                            required
                            @class([$fieldBase, 'border-rose-500 ring-1 ring-rose-500/30 dark:border-rose-400' => $errors->has('precio')])
                        />
                        <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Valor base para cada pasajero.</p>
                        @error('precio')
                            <p class="mt-1 text-sm text-rose-600 dark:text-rose-400" role="alert">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="fecha" class="text-sm font-medium text-zinc-700 dark:text-zinc-200">Fecha y hora</label>
                        <input
                            id="fecha"
                            type="datetime-local"
                            name="fecha"
                            value="{{ old('fecha') }}"
                            required
                            @class([$fieldBase, 'border-rose-500 ring-1 ring-rose-500/30 dark:border-rose-400' => $errors->has('fecha')])
                        />
                        <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Selecciona la hora exacta de salida.</p>
                        @error('fecha')
                            <p class="mt-1 text-sm text-rose-600 dark:text-rose-400" role="alert">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            <section class="flex flex-col gap-3 rounded-2xl border border-zinc-200/70 bg-white/80 px-6 py-4 shadow-sm dark:border-zinc-800 dark:bg-zinc-900/60 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Acciones</h3>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Revisa antes de guardar la informacion.</p>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row">
                    <a
                        href="{{ route('flightsList') }}"
                        class="inline-flex items-center justify-center rounded-lg border border-zinc-200 bg-white px-4 py-2 text-sm font-semibold text-zinc-700 shadow-sm transition hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-200 dark:hover:bg-zinc-800"
                    >
                        Cancelar
                    </a>
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-sky-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-400/60 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-zinc-950"
                    >
                        Crear vuelo
                    </button>
                </div>
            </section>
        </form>
    </div>
</x-layouts.app>
