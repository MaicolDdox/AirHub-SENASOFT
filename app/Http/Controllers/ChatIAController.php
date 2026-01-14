<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI;

class ChatIAController extends Controller
{
    public function chat(Request $request)
    {
        $msg = trim($request->input('message', ''));

        // Protección básica
        if ($msg === '') {
            return response()->json(['reply' => 'Por favor escribe algo.']);
        }

        $client = OpenAI::client(env('OPENAI_API_KEY'));

        //  "Cerebro" del bot — ahora con entrenamiento rápido sobre tu sistema
        $response = $client->chat()->create([
            'model' => 'gpt-4o-mini',
            'temperature' => 0.2,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => "Eres TicketBot, el asistente oficial del sistema web Ticket Friends.
                    Tu función es explicar las vistas, botones y flujo del sistema.
                    Nunca hables de otros temas fuera de la aplicación.

                    Guía del sistema Ticket Friends:
                    - Inicio: muestra información de la empresa y el botón para buscar vuelos.
                    - Vuelos: permite buscar y seleccionar un vuelo (origen, destino, fecha, aerolínea, precio).
                    - Detalle de vuelo / detalles de vuelos:** muestra información del vuelo y el botón 'Seleccionar asientos'.
                    - Formulario de pasajeros: recoge los datos de los pasajeros.
                    - Selección de asientos: muestra el avión con asientos disponibles; el usuario elige sus asientos.
                    - Pago: formulario para simular el pago (tarjeta, PayPal), confirmar y generar ticket.
                    - Tickets / Facturas: muestra las reservas hechas con su token y botón 'Exportar PDF'.
                    - Botón Exportar PDF: genera y descarga una copia en PDF del ticket o factura.
                    - Inicio / Cerrar sesión: permiten acceder o salir del sistema según el rol del usuario.

                    Responde siempre de forma clara, breve y amable, guiando al usuario sobre qué hace cada botón o vista."
                    ],
                ['role' => 'user', 'content' => $msg],
            ],
        ]);

        return response()->json([
            'reply' => $response->choices[0]->message->content ?? 'Sin respuesta',
        ]);
    }
}
