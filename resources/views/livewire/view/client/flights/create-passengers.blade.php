@extends('app')
@section('content')

    {{-- Contenedor principal --}}
    <main class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8 lg:py-12">

        {{-- Encabezado de la página --}}
        <header class="mb-8">
            <h1 class="text-3xl lg:text-4xl font-bold text-slate-900 tracking-tight mb-2">
                Registrar pasajeros
            </h1>
            <p class="text-base text-slate-600 leading-7">
                Complete la información de los pasajeros para el vuelo <span class="font-semibold text-sky-600">#{{ $flight->id }}</span>
            </p>
        </header>

        {{-- Mensajes de retroalimentación --}}
        @if (session('success'))
            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 shadow-sm" role="alert">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" role="img" aria-label="Éxito">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 shadow-sm" role="alert">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" role="img" aria-label="Error">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                    <div class="flex-1">
                        <strong class="block text-sm font-semibold text-red-800 mb-2">Ocurrieron algunos errores:</strong>
                        <ul class="list-disc list-inside space-y-1 text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Info Notice --}}
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm text-blue-800">
                    Si tu pasajero es un niño o un bebe de 2 años para abajo, descuide usuario. no paga por el asiento.
                </p>
            </div>
        </div>

        {{-- Formulario principal --}}
        <form action="{{ route('user_passengers.store') }}" method="POST" class="space-y-6">
            @csrf

            <input type="hidden" name="flight_id" value="{{ $flight->id }}">

            {{-- Contenedor dinámico de pasajeros --}}
            <div id="form-container" class="space-y-6"></div>

            {{-- Botón de envío --}}
            <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-200">
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded-lg bg-sky-600 px-6 py-3 font-medium text-white shadow-sm transition duration-200 ease-out hover:bg-sky-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-sky-300 focus:ring-offset-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" role="img" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Registrar Pasajeros
                </button>
            </form>

            {{-- Boton de Salir --}}
            <button
                    class="inline-flex items-center gap-2 rounded-lg bg-gray-400 px-6 py-3 font-medium text-white shadow-sm transition duration-200 ease-out hover:bg-gray-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-sky-300 focus:ring-offset-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" role="img" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <a href="{{ route('home') }}">Salir</a>
                </button>
            </div>
    </main>

    {{-- Script de generación dinámica de formularios --}}
    <script>
        const cantidadPasajeros = {{ $cantidad }};
        const contenedor = document.getElementById('form-container');

        for (let i = 1; i <= cantidadPasajeros; i++) {
            const div = document.createElement('div');
            div.classList.add('rounded-2xl', 'border', 'border-slate-200', 'bg-white', 'shadow-sm', 'p-6', 'transition', 'duration-200', 'hover:shadow-md');

            div.innerHTML = `
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-sky-50 text-sky-600 font-semibold">
                        ${i}
                    </div>
                    <h2 class="text-lg font-semibold text-slate-900">Pasajero ${i}</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label for="passenger-${i}-first-name" class="block text-sm font-medium text-slate-700 mb-2">
                            Primer nombre <span class="text-red-500" aria-label="requerido">*</span>
                        </label>
                        <flux:input
                            type="text"
                            id="passenger-${i}-first-name"
                            name="passengers[${i}][first_name]"
                            class="w-full"
                            required
                            aria-required="true"
                        />
                    </div>

                    <div>
                        <label for="passenger-${i}-middle-name" class="block text-sm font-medium text-slate-700 mb-2">
                            Segundo nombre
                        </label>
                        <flux:input
                            type="text"
                            id="passenger-${i}-middle-name"
                            name="passengers[${i}][middle_name]"
                            class="w-full"
                        />
                    </div>

                    <div>
                        <label for="passenger-${i}-first-surname" class="block text-sm font-medium text-slate-700 mb-2">
                            Primer apellido <span class="text-red-500" aria-label="requerido">*</span>
                        </label>
                        <flux:input
                            type="text"
                            id="passenger-${i}-first-surname"
                            name="passengers[${i}][first_surname]"
                            class="w-full"
                            required
                            aria-required="true"
                        />
                    </div>

                    <div>
                        <label for="passenger-${i}-middle-surname" class="block text-sm font-medium text-slate-700 mb-2">
                            Segundo apellido <span class="text-red-500" aria-label="requerido">*</span>
                        </label>
                        <flux:input
                            type="text"
                            id="passenger-${i}-middle-surname"
                            name="passengers[${i}][middle_surname]"
                            class="w-full"
                            required
                            aria-required="true"
                        />
                    </div>

                    <div>
                        <label for="passenger-${i}-birth-date" class="block text-sm font-medium text-slate-700 mb-2">
                            Fecha de nacimiento <span class="text-red-500" aria-label="requerido">*</span>
                        </label>
                        <flux:input
                            type="date"
                            id="passenger-${i}-birth-date"
                            name="passengers[${i}][fecha_nacimiento]"
                            class="w-full"
                            required
                            aria-required="true"
                        />
                    </div>

                    <div>
                        <label for="passenger-${i}-gender" class="block text-sm font-medium text-slate-700 mb-2">
                            Género <span class="text-red-500" aria-label="requerido">*</span>
                        </label>
                        <flux:select
                            id="passenger-${i}-gender"
                            name="passengers[${i}][genero]"
                            class="w-full"
                            required
                            aria-required="true"
                        >
                            <flux:select.option value="">Seleccione...</flux:select.option>
                            <flux:select.option value="Masculino">Masculino</flux:select.option>
                            <flux:select.option value="Femenino">Femenino</flux:select.option>
                            <flux:select.option value="Otro">Otro</flux:select.option>
                        </flux:select>
                    </div>

                    <div>
                        <label for="passenger-${i}-doc-type" class="block text-sm font-medium text-slate-700 mb-2">
                            Tipo de documento <span class="text-red-500" aria-label="requerido">*</span>
                        </label>
                        <flux:select
                            id="passenger-${i}-doc-type"
                            name="passengers[${i}][type_document]"
                            class="w-full"
                            required
                            aria-required="true"
                        >
                            <flux:select.option value="">Seleccione...</flux:select.option>
                            <flux:select.option value="Tarjeta de Identidad">Tarjeta Identidad</flux:select.option>
                            <flux:select.option value="Cédula de Ciudadanía">Cédula de Ciudadanía</flux:select.option>
                            <flux:select.option value="Cédula de Extranjería">Cédula de Extranjería</flux:select.option>
                            <flux:select.option value="Pasaporte">Pasaporte</flux:select.option>
                            <flux:select.option value="Registro Civil">Registro Civil</flux:select.option>
                        </flux:select>
                    </div>

                    <div>
                        <label for="passenger-${i}-doc-number" class="block text-sm font-medium text-slate-700 mb-2">
                            Número de documento <span class="text-red-500" aria-label="requerido">*</span>
                        </label>
                        <flux:input
                            type="number"
                            id="passenger-${i}-doc-number"
                            name="passengers[${i}][number_document]"
                            class="w-full"
                            required
                            aria-required="true"
                        />
                    </div>

                    <div>
                        <label for="passenger-${i}-phone" class="block text-sm font-medium text-slate-700 mb-2">
                            Teléfono <span class="text-red-500" aria-label="requerido">*</span>
                        </label>
                        <flux:input
                            type="number"
                            id="passenger-${i}-phone"
                            name="passengers[${i}][number_phone]"
                            class="w-full"
                            required
                            aria-required="true"
                        />
                    </div>

                    <div>
                        <label for="passenger-${i}-email" class="block text-sm font-medium text-slate-700 mb-2">
                            Email
                        </label>
                        <flux:input
                            type="email"
                            id="passenger-${i}-email"
                            name="passengers[${i}][email]"
                            class="w-full"
                        />
                    </div>
                </div>
            `;

            contenedor.appendChild(div);
        }
    </script>

</body>
</html>
@endsection
