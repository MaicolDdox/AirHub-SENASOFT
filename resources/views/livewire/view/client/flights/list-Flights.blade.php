@extends('app')

@section('title', 'Inicio - AirHub')

@section('content')
    {{-- SECCIÓN DE CATÁLOGO DE VUELOS --}}
    <section class="py-12 sm:py-16 bg-slate-50">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-2">Vuelos disponibles</h2>
                    <p class="text-slate-600">Encuentra las mejores ofertas para tu próximo viaje</p>
                </div>
                <a href="{{ route('flights.indexWelcome') }}" class="hidden sm:inline-flex items-center gap-2 text-sky-600 font-medium hover:text-sky-700 transition-colors duration-200">
                    Ver todos los vuelos
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>

            {{-- Incluir el catálogo --}}
            @include('livewire.view.client.flights.catalog')
        </div>
    </section>
@endsection


