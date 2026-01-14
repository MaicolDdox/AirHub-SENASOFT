<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Position;
use App\Models\UserPassenger;
use App\Models\UserPayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PositionController extends Controller
{
    public function selectPayer($flight_id)
    {
        $user = Auth::user();

        // Crea o trae el payer del usuario logueado para este vuelo
        $userPayer = UserPayer::firstOrCreate(
            [
                'user_id'   => $user->id,
                'flight_id' => $flight_id,
            ],
            [
                'rol'       => 'user_payer', // o 'comprador' si prefieres
            ]
        );

        $flight    = Flight::with('positions')->findOrFail($flight_id);
        $positions = Position::where('flight_id', $flight_id)->get();

        return view('livewire.view.client.positions.selectPayer',
            compact('flight', 'positions', 'userPayer'));
    }

    public function storePayer(Request $request, $flight_id)
    {
        $request->validate([
            'seat_number' => 'required|string',
        ]);

        $user = Auth::user();
        $userPayer = UserPayer::where('user_id', $user->id)
            ->where('flight_id', $flight_id)
            ->firstOrFail();

        // Buscar el asiento que coincide (ya creado por el seeder)
        $position = Position::where('flight_id', $flight_id)
            ->where('seat_number', $request->seat_number)
            ->first();

        if (! $position) {
            return back()->with('error', 'El asiento no existe.');
        }

        // Verificar si ya está ocupado
        if ($position->estado === 'ocupado') {
            return back()->with('error', 'Ese asiento ya está ocupado.');
        }

        // Actualizar el registro existente
        $position->user_payer_id = $userPayer->id;
        $position->user_passenger_id = null;
        $position->estado = 'ocupado';
        $position->save();

        if ($request->userPassenger == 0) {
            return redirect()->route('pays.create.id', $flight_id)
            ->with('success', 'Asientos de pasajeros asignados correctamente.');
        }else
        {
            return redirect()->route('positions.selectPassengers', $flight_id)
                ->with('success', 'Asiento seleccionado correctamente.');
        }
    }

    public function selectPassengers($flight_id)
    {
        $userPayer = UserPayer::where('user_id', Auth::id())
            ->where('flight_id', $flight_id)
            ->firstOrFail();

        $flight = Flight::with('positions', 'origin', 'destinie', 'model_plane')->findOrFail($flight_id);
        $positions = Position::where('flight_id', $flight_id)->get();

        // Cantidad de pasajeros que compró el payer
        $passengerCount = $userPayer->flight->userPassenger ?? 0; // o la propiedad que tengas

        // Tomar los últimos pasajeros creados por este payer en este vuelo
        $passengers = UserPassenger::where('user_payer_id', $userPayer->id)
            ->where('flight_id', $flight_id)
            ->orderBy('created_at', 'desc')
            ->take($passengerCount)
            ->get();

        return view('livewire.view.client.positions.selectPassengers', compact('flight', 'positions', 'userPayer', 'passengers'));
    }

    public function storePassengers(Request $request, $flight_id)
    {
        $request->validate([
            'passenger_seats' => 'required|array',
            'passenger_seats.*' => 'required|string',
        ]);

        $userPayer = UserPayer::where('user_id', Auth::id())
            ->where('flight_id', $flight_id)
            ->firstOrFail();

        $passengers = UserPassenger::where('user_payer_id', $userPayer->id)->get();
        $seats = $request->passenger_seats;

        foreach ($passengers as $index => $passenger) {
            $seatNumber = $seats[$index] ?? null;
            if (! $seatNumber) {
                continue; // si no hay asiento, saltar
            }

            // Buscar el registro existente de Position para ese asiento
            $position = Position::where('flight_id', $flight_id)
                ->where('seat_number', $seatNumber)
                ->first();

            if (! $position) {
                return back()->with('error', "El asiento $seatNumber no existe en la base de datos.");
            }

            // Verificar si ya está ocupado
            if ($position->estado === 'ocupado') {
                return back()->with('error', "El asiento $seatNumber ya está ocupado.");
            }

            // Actualizar el registro existente
            $position->user_passenger_id = $passenger->id;
            $position->user_payer_id = null; // para seguridad
            $position->estado = 'ocupado';
            $position->save();
        }

        return redirect()->route('pays.create.id', $flight_id)
            ->with('success', 'Asientos de pasajeros asignados correctamente.');
    }
}
