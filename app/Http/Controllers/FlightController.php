<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\ModelPlane;
use App\Models\Airline;
use App\Models\Origin;
use App\Models\Destinie;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $flights = Flight::with(['origin', 'destinie', 'airline', 'model_plane'])->get();
        return view('flightsList', compact('flights'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $modelos = ModelPlane::all();
        $aerolineas = Airline::all();
        $origenes = Origin::all();
        $destinos = Destinie::all();


        return view('flightsCreate', compact(['modelos', 'aerolineas', 'origenes', 'destinos']));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'origen' => 'required|exists:origins,id',
            'destino' => 'required|exists:destinies,id',
            'aerolinea' => 'required|exists:airlines,id',
            'aerolinea' => 'required|exists:model_planes,id',
            'precio' => 'required|numeric|min:0',
            'fecha' => 'required',
        ]);

        $vuelo = new Flight;

        $vuelo->origin_id = $request->origen;
        $vuelo->destinie_id = $request->destino;
        $vuelo->model_plane_id = $request->modelo;
        $vuelo->airline_id = $request->aerolinea;
        $vuelo->positionValue = $request->precio;
        $vuelo->dateHour = $request->fecha;

        $id_modelo = $request->modelo;

        $modelo = ModelPlane::find($id_modelo);
        $cupos = $modelo->capacidad;

        $vuelo->cantCupos = $cupos;

        $vuelo->save();

        return redirect(route('flightsList'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Flight $flight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flight $flight)
    {
        return view('livewire.view.client.flights.edit-Flight', compact('flight'));
    }

    /**
     * Update the specified resource in storage.
     */

    // Cambia el estado de un vuelo

    public function changeStatus(Request $request){

        $flight = Flight::find($request->vuelo);

        if($flight->estado == 'disponible'){

            $flight->estado = 'lleno';

        } else if ($flight->estado == 'lleno'){

            $flight->estado = 'disponible';

        }

        $flight->save();

        return redirect(route('flightsList'));

    }

    public function update(Request $request, Flight $flight)
    {
        $request->validate([
            'userPassenger' => 'required|integer|min:0',
        ]);

        if ($request->userPassenger == 0)
        {
            $nuevosCupos = $flight->cantCupos - 1;
        }
        else
        {
            $nuevosCupos = $flight->cantCupos - $request->userPassenger;
        }

        if ($nuevosCupos < 0) {
            return back()->with('error', 'No hay suficientes cupos disponibles para esa cantidad de pasajeros.');
        }

        $flight->cantCupos = $nuevosCupos;
        $flight->userPassenger = $request->userPassenger;
        $flight->estado = $nuevosCupos == 0 ? 'lleno' : 'disponible';
        $flight->save();

        // Si la $userPassenger == 0 entonces se salta el formulario de pasajeros
        if ($request->userPassenger == 0) {
            return redirect()
                ->route('positions.selectPayer', ['flight_id' => $flight->id]);
        }else
        {
            return redirect()
                ->route('user_passengers.create.withFlight', ['flight_id' => $flight->id, 'cantidad' => $request->userPassenger]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        //
    }

    public function indexWelcome()
    {

        $origenes = Origin::all();
        $destinos = Destinie::all();
        $flights = Flight::with(['origin', 'destinie', 'airline', 'model_plane'])->where('estado', 'disponible')->get();

        return view('livewire.view.client.flights.list-Flights', compact(['flights', 'origenes', 'destinos']));
    }
}
