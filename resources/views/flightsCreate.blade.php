<x-layouts.app :title="__('Dashboard')">
    <div class="rounded p-3 shadow-xl">
        <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">
            Información del Vuelo 
        </h2>
        <form action="{{route('flight.store')}}" method="POST">
            @csrf

            {{-- Origen --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Origen</label>
                <select name="origen" id="" class="w-full bg-gray-100 border border-gray-300 rounded-lg p-2">
                    @foreach ($origenes as $origen)
                        <option value="{{$origen->id}}">{{$origen->origin}}</option>
                    @endforeach
                </select>
                @error('origen')
                    {{$message}}
                @enderror
            </div>

            {{-- Destino --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Destino</label>
                <select name="destino" id="" class="w-full bg-gray-100 border border-gray-300 rounded-lg p-2">
                    @foreach ($destinos as $destino)
                        <option value="{{$destino->id}}">{{$destino->destinie}}</option>
                    @endforeach
                </select>
                @error('destino')
                    {{$message}}
                @enderror
            </div>

            {{-- Aerolínea --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Modelo</label>
                <select name="aerolinea" id="" class="w-full bg-gray-100 border border-gray-300 rounded-lg p-2">
                    @foreach ($aerolineas as $aerolinea)
                        <option value="{{$aerolinea->id}}">{{$aerolinea->airline}}</option>
                    @endforeach
                </select>
                @error('aerolinea')
                    {{$message}}
                @enderror
            </div>

            {{-- Precio por asiento --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Precio por asiento</label>
                <input type="number" name="precio" class="w-full bg-gray-100 border border-gray-300 rounded-lg p-2">
            </div>

            {{-- Fecha --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Fecha y hora</label>
                <input type="datetime-local" name="fecha" class="w-full bg-gray-100 border border-gray-300 rounded-lg p-2">
            </div>

            {{-- Modelo de avion --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Modelo</label>
                <select name="modelo" id="" class="w-full bg-gray-100 border border-gray-300 rounded-lg p-2">
                    @foreach ($modelos as $modelo)
                        <option value="{{$modelo->id}}">{{$modelo->marca}}</option>
                    @endforeach
                </select>
                @error('modelo')
                    {{$message}}
                @enderror
            </div>

            {{-- Botón --}}
            <button type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
                Crear vuelo
            </button>
        </form>
    </div>
</x-layouts.app>