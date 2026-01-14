<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Flight;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

         // id del user_payer autenticado (evita error si no tiene)
    $userPayerId = Auth::user()->user_payers()->value('id');

    if (!$userPayerId) {
        // Decide: redirigir o devolver lista vacía
        $tickets = collect();
        return view('livewire.view.client.report.tikect', compact('tickets'));
    }

        $tickets = Ticket::with(['flight.user_passengers', 'flight.positions'])
                    ->where('user_payer_id', $userPayerId)
                    ->get();


        return view('livewire.view.client.report.tikect', compact('tickets'));

    }

    // visualiza las reservas que hizo el usuario
    public function reservas()
    {


        $user_id = Auth::user()->id;
        $reservas = Ticket::with('flight')->where('user_payer_id', $user_id)->get();

        return view('livewire.view.client.flights.reservas', compact('reservas'));

    }


    public function reserva($id)
    {

        $reserva = Ticket::find($id);

        return view('livewire.view.client.flights.reserva', compact('reserva'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
