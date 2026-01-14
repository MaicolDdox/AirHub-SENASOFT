<x-layouts.app :title="__('FlightsList')">
    <a href="{{route('flight.create')}}">
        <div class="w-fit rounded m-2 p-2 text-white bg-blue-500">
            Crear vuelo
        </div>
    </a>
    <table class="table-fixed w-full border-collapse bg-white shadow-md rounded-lg">
        <thead>
            <tr class="bg-gray-800 text-white">
                <th class="p-4 text-left text-sm font-semibold">ID</th>
                <th class="p-4 text-left text-sm font-semibold">Origen</th>
                <th class="p-4 text-left text-sm font-semibold">Destino</th>
                <th class="p-4 text-left text-sm font-semibold">Modelo</th>
                <th class="p-4 text-left text-sm font-semibold">Aerolínea</th>
                <th class="p-4 text-left text-sm font-semibold">Fecha de vuelo</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($flights as $flight)
                <tr class="hover:bg-gray-100 even:bg-gray-50 border-b border-gray-200">
                    <td class="p-4 text-sm text-gray-700">{{ $flight->id }}</td>
                    <td class="p-4 text-sm text-gray-700">{{ $flight->origin->origin }}</td>
                    <td class="p-4 text-sm text-gray-700">{{ $flight->destinie->destinie }}</td>
                    <td class="p-4 text-sm text-gray-700">{{ $flight->model_plane->marca }}</td>
                    <td class="p-4 text-sm text-gray-700">{{ $flight->airline->airline }}</td>
                    <td class="p-4 text-sm text-gray-700">{{ $flight->dateHour }}</td>
                    <td class="p-4 text-sm text-gray-700">


                        {{-- Continyar aqui --}}


                        <form action="{{route('change.status')}}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" name="vuelo" class="hidden" value="{{$flight->id}}">
                            <button type="submit" class="rounded hover:bg-blue-950 p-2 text-white bg-blue-500">
                                <p>
                                    Cambiar a 
                                    @if ($flight->estado == 'disponible')
                                        lleno
                                    @else
                                        disponible
                                    @endif
                                </p>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-500 text-sm">
                        No hay vuelos disponibles en este momento
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-layouts.app>