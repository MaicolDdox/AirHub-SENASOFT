<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;               
use App\Models\Ticket;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;

class PdfController extends Controller
{
    public function pdfExportTickets()
    {
        $userId = Auth::user()->user_payers->first()->id;
        $tickets = Ticket::where('user_payer_id', $userId)->get();
        $html = view('livewire.view.client.report.pdf-tikect', compact('tickets'))->render();

        $pdfPhat = storage_path('app/public/pdf/tickets.pdf');
        Browsershot::html($html)
            ->setOption('args', ['--no-sandbox'])
            ->format('A4')
            ->margins(10, 10, 10, 10)
            ->save($pdfPhat);

        return response()->download($pdfPhat)->deleteFileAfterSend(false);
    }
}
