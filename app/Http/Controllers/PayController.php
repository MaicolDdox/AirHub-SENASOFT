<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Pay;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PayController extends Controller
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
    public function create($flight_id)
    {
        $flight = Flight::findOrFail($flight_id);

        return view('livewire.view.pay.metodoPay', compact('flight'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'metodoPago' => 'required|string|max:255',
            'flight_id' => 'required|integer|exists:flights,id',
        ]);

        $flight = Flight::findOrFail($validated['flight_id']);
        $valorXpuesto = $flight->positionValue;

        if ($request->userPassenger == 0) {
            $total = $valorXpuesto;
        }
        else
        {
            $cantidadPeople = $flight->userPassenger;
            $total = $cantidadPeople * $valorXpuesto;
        }


        $validated['flight_id'] = $flight->id;
        $validated['user_payer_id'] = Auth::user()->user_payers->first()->id;
        $validated['cantPasajeros'] = $request->userPassenger;
        $validated['total'] = $total;

        Pay::create($validated);

        Session::flash('alert', [
        'icon' => 'success',
        'title' => '¡Éxito!',
        'text' => 'Compra Exitosa!!.',
        ]);

        Ticket::create([
            'flight_id' => $flight->id,
            'user_payer_id' => Auth::user()->user_payers->first()->id,
            'cantPasajeros' => $request->userPassenger,
            'token' => Str::random(10),
        ]);

        return redirect()->route('tickets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pay $pay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pay $pay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pay $pay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pay $pay)
    {
        //
    }
}
