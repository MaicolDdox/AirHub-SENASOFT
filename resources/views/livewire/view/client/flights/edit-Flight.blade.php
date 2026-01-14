@extends('app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-sky-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        {{-- Header --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-sky-600 rounded-full mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Información del Vuelo</h1>
            <p class="text-slate-600">Revisa los detalles y confirma tu reserva</p>
        </div>

        {{-- Main Card --}}
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
            <form action="{{ route('flights.update', $flight->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Flight Route Header --}}
                <div class="bg-gradient-to-r from-sky-600 to-sky-700 px-6 py-8 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sky-100 text-sm mb-1">Origen</p>
                            <p class="text-2xl font-bold">{{ $flight->origin->origin }}</p>
                        </div>
                        <div class="flex-shrink-0 mx-4">
                            <svg class="w-8 h-8 text-sky-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </div>
                        <div class="flex-1 text-right">
                            <p class="text-sky-100 text-sm mb-1">Destino</p>
                            <p class="text-2xl font-bold">{{ $flight->destinie->destinie }}</p>
                        </div>
                    </div>
                </div>

                {{-- Flight Details --}}
                <div class="p-6 space-y-6">
                    {{-- Airline & Aircraft --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="flex items-center text-sm font-semibold text-slate-700 mb-2">
                                <svg class="w-5 h-5 mr-2 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                Aerolínea
                            </label>
                            <div class="relative">
                                <input type="text" value="{{ $flight->airline->airline }}"
                                    disabled class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 font-medium">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="flex items-center text-sm font-semibold text-slate-700 mb-2">
                                <svg class="w-5 h-5 mr-2 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                Modelo de avión
                            </label>
                            <div class="relative">
                                <input type="text" value="{{ $flight->model_plane->marca }}"
                                    disabled class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 font-medium">
                            </div>
                        </div>
                    </div>

                    {{-- Date & Price --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="flex items-center text-sm font-semibold text-slate-700 mb-2">
                                <svg class="w-5 h-5 mr-2 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Fecha y hora
                            </label>
                            <div class="relative">
                                <input type="text" value="{{ \Carbon\Carbon::parse($flight->dateHour)->format('d/m/Y H:i') }}"
                                    disabled class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 font-medium">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="flex items-center text-sm font-semibold text-slate-700 mb-2">
                                <svg class="w-5 h-5 mr-2 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Precio por asiento
                            </label>
                            <div class="relative">
                                <input type="text" value="${{ number_format($flight->positionValue, 0, ',', '.') }}"
                                    disabled class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-900 font-bold text-lg">
                            </div>
                        </div>
                    </div>

                    {{-- Available Seats --}}
                    <div class="bg-sky-50 border border-sky-200 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span class="text-sm font-semibold text-slate-700">Cupos disponibles</span>
                            </div>
                            <span class="text-2xl font-bold text-sky-600">{{ $flight->cantCupos }}</span>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-slate-200"></div>

                    {{-- Passenger Selection --}}
                    <div class="space-y-2">
                        <label class="flex items-center text-sm font-semibold text-slate-700 mb-2">
                            <svg class="w-5 h-5 mr-2 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            Cantidad de pasajeros
                        </label>
                        <select name="userPassenger" required
                            class="w-full border border-slate-300 rounded-lg px-4 py-3 text-slate-900 font-medium focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all duration-200 cursor-pointer hover:border-sky-400">
                            <option value="" selected disabled>Selecciona la cantidad de pasajeros</option>
                            <option value="0">Solo Yo</option>
                            <option value="1">+1 pasajero</option>
                            <option value="2">+2 pasajeros</option>
                            <option value="3">+3 pasajeros</option>
                            <option value="4">+4 pasajeros</option>
                            <option value="5">+5 pasajeros</option>
                        </select>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-sky-600 to-sky-700 hover:from-sky-700 hover:to-sky-800 text-white font-bold py-4 rounded-lg transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl flex items-center justify-center group">
                        <svg class="w-5 h-5 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Confirmar Compra
                    </button>
                </div>
            </form>
        </div>

        {{-- Info Notice --}}
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm text-blue-800">
                    Al confirmar la compra, recibirás un correo electrónico con los detalles de tu reserva y las instrucciones para completar el pago.
                    No registrar como pasajero a su hijo o niño menor de 2 años.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
