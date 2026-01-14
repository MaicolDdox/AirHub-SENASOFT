<?php

use App\Http\Controllers\ChatIAController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserPassengerController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('FlightsList', [FlightController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('flightsList');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');

    // =======================
    // RUTAS PARA LOS USUARIOS
    // =======================

    // <<<<<<<<<<>>>>>>>>>>>>>>
    // Rutas de la tabla Flight
    // <<<<<<<<<<>>>>>>>>>>>>>>

    // Ruta para poder traer los datos al welcome
    Route::get('flights/indexWelcome', [FlightController::class, 'indexWelcome'])
        ->name('flights.indexWelcome');

    Route::resource('flights', FlightController::class);

    Route::get('flightCreate', [FlightController::class, 'create'])->name('flight.create');
    Route::post('flightStore', [FlightController::class, 'store'])->name('flight.store');

    Route::put('changeStatus', [FlightController::class, 'changeStatus'])->name('change.status');

    // <<<<<<<<<<>>>>>>>><<<<<<<<<<>>>>>
    // Rutas de la tabla user_passengers
    // <<<<<<<<<<>>>>>>>><<<<<<<<<<>>>>>
    Route::get('user_passengers/create/{flight_id}', [UserPassengerController::class, 'create'])
        ->name('user_passengers.create.withFlight');

    Route::resource('user_passengers', UserPassengerController::class);

    // <<<<<<<<<<>>>>>>>>>>>>>><<<<<>>>>>>>>>>>
    // Rutas de la tabla de seleccion de puesto
    // <<<<<<<<<<>>>>>>>>>>>>>><<<<<>>>>>>>>>>>

    Route::get('/positions/select/{flight_id}', [PositionController::class, 'selectPayer'])->name('positions.selectPayer');
    Route::put('/positions/select/{flight_id}', [PositionController::class, 'storePayer'])->name('positions.storePayer');

    Route::get('/positions/select-passengers/{flight_id}', [PositionController::class, 'selectPassengers'])->name('positions.selectPassengers');
    Route::put('/positions/store-passengers/{flight_id}', [PositionController::class, 'storePassengers'])->name('positions.storePassengers');

    // <<<<<<<<<<>>>>>>>><<<<<<<<<<>>>>>>>
    // Rutas para validar metodo de pago
    // <<<<<<<<<<>>>>>>>><<<<<<<<<<>>>>>>>
    Route::get('/pays/create/{flight_id}', [PayController::class, 'create'])->name('pays.create.id');
    Route::resource('pays', PayController::class);


    //<<<<<<<<<<>>>>>>>>>>>>>><<<<<>>>>>>>>>>>
    //Ruta para la generacion de tickets<<<>>>
    //<<<<<<<<<<>>>>>>>>>>>>>><<<<<>>>>>>>>>>>

    Route::resource('tickets', TicketController::class);
    Route::get('reservas', [TicketController::class, 'reservas'])->name('reservas.index');
    Route::get('reserva/{id}', [TicketController::class, 'reserva'])->name('reserva.show');

    // <<<<<<<<<<>>>>>>>>>>>>>><<<<<>>>>>>>>>>>
    // <<<<<<<Ruta para exportar en pdf<<<<<<<<
    // <<<<<<<<<<>>>>>>>>>>>>>><<<<<>>>>>>>>>>>
    Route::get('pdf/generar', [PdfController::class, 'pdfExportTickets'])
        ->name('pdf.generar');


    // <<<<<<<<<<>>>>>>>>>>>>>><<<<<>>>>>>>>>>>
    // <<<<<<<Ruta para la api de ia<<<<<<<<<<<
    // <<<<<<<<<<>>>>>>>>>>>>>><<<<<>>>>>>>>>>>
    Route::get('/chat-ia', function () {
        return view('chat.ia'); // Vista del chat (resources/views/chat/ia.blade.php)
    })->name('chat.ia');

    Route::post('/api/chat-ia', [ChatIAController::class, 'chat'])->name('chat.ia.api');
});
