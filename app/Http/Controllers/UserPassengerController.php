<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\UserPassenger;
use App\Models\UserPayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $flight_id)
    {
        $flight = Flight::findOrFail($flight_id);
        $cantidad = $request->input('cantidad');

        return view('livewire.view.client.flights.create-passengers', compact('flight', 'cantidad'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'passengers' => 'required|array|min:1',
            'passengers.*.first_name'      => 'required|string|max:100',
            'passengers.*.middle_name'     => 'nullable|string|max:100',
            'passengers.*.first_surname'   => 'required|string|max:100',
            'passengers.*.middle_surname'  => 'nullable|string|max:100',
            'passengers.*.fecha_nacimiento' => [
                'required',
                'date',
                'before_or_equal:' . now()->subYears(3)->format('Y-m-d'),
            ],
            'passengers.*.genero'          => 'required',
            'passengers.*.email'           => 'nullable|email',
            'passengers.*.type_document'   => 'required|string|max:50',
            'passengers.*.number_document' => 'required|string|max:50',
            'passengers.*.number_phone'    => 'required|string|max:30',
        ]);

        $user = Auth::user();

        // Verificar si el usuario ya tiene un registro en user_payers
        $userPayer = UserPayer::where('user_id', $user->id)->first();

        if (! $userPayer) {
            //  Si no existe, se crea con el vuelo actual
            $userPayer = UserPayer::create([
                'user_id' => $user->id,
                'flight_id' => $validated['flight_id'],
                'rol' => 'user_payer',
            ]);
        } else {
            //  Si existe pero el vuelo es diferente, solo actualizamos el flight_id
            if ($userPayer->flight_id != $validated['flight_id']) {
                $userPayer->update([
                    'flight_id' => $validated['flight_id'],
                ]);
            }
        }

        //  Registrar cada pasajero hijo
        foreach ($validated['passengers'] as $data) {
            UserPassenger::create([
                'flight_id' => $validated['flight_id'],
                'user_payer_id' => $userPayer->id,
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'] ?? null,
                'first_surname' => $data['first_surname'],
                'middle_surname' => $data['middle_surname'],
                'fecha_nacimiento' => $data['fecha_nacimiento'],
                'genero' => $data['genero'],
                'email' => $data['email'] ?? null,
                'type_document' => $data['type_document'],
                'number_document' => $data['number_document'],
                'number_phone' => $data['number_phone'],
            ]);
        }

        return redirect()->route('positions.selectPayer', ['flight_id' => $validated['flight_id']]);

    }

    /**
     * Display the specified resource.
     */
    public function show(UserPassenger $userPassenger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserPassenger $userPassenger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserPassenger $userPassenger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserPassenger $userPassenger)
    {
        //
    }
}
