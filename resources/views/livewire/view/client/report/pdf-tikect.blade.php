<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TICKETS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        /* Enhanced CSS variables with professional airline color palette */
        :root{
            --bg: #f0f4f8;
            --card-bg: #ffffff;
            --text: #1e293b;
            --muted: #64748b;
            --border: #e2e8f0;
            --accent: #0f172a;
            --primary: #0284c7;
            --primary-light: #e0f2fe;
            --shadow: 0 4px 6px -1px rgba(0,0,0,.08), 0 2px 4px -1px rgba(0,0,0,.04);
            --shadow-lg: 0 10px 25px -5px rgba(0,0,0,.1), 0 8px 10px -6px rgba(0,0,0,.08);
        }

        *{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body{
            background: var(--bg);
            color: var(--text);
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji","Segoe UI Emoji";
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            font-size: 15px;
        }

        /* Improved container with better spacing */
        .container{
            max-width: 920px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Enhanced h1 with accent bar */
        h1{
            font-size: 32px;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin: 0 0 32px 0;
            color: var(--accent);
            position: relative;
            padding-bottom: 16px;
        }
        h1::after{
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            border-radius: 2px;
        }

        /* Enhanced card with better shadows and hover effect */
        .card{
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px;
            margin-bottom: 24px;
            box-shadow: var(--shadow);
            page-break-inside: avoid;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .card::before{
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), #38bdf8);
        }
        .card:hover{
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        /* Improved ticket header with better alignment */
        .ticket-header{
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 24px;
            gap: 16px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--primary-light);
        }
        .ticket-title{
            margin: 0 0 6px 0;
            font-size: 20px;
            font-weight: 700;
            color: var(--accent);
            letter-spacing: -0.3px;
        }
        .ticket-meta{
            margin: 0;
            font-size: 13px;
            color: var(--muted);
            font-weight: 500;
        }
        /* Enhanced ticket number with badge style */
        .ticket-number{
            text-align: right;
            font-weight: 700;
            color: var(--primary);
            font-size: 14px;
            white-space: nowrap;
            background: var(--primary-light);
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid #bae6fd;
        }

        /* Enhanced grid with better spacing */
        .grid{
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px 24px;
            margin-bottom: 20px;
        }
        @media (max-width: 640px){
            .grid{
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }

        /* Improved field labels with icons-like styling */
        .field-label{
            font-size: 12px;
            color: var(--muted);
            font-weight: 600;
            margin: 0 0 6px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .field-value{
            margin: 0;
            color: var(--accent);
            font-size: 15px;
            font-weight: 600;
        }

        /* Enhanced divider with better visual separation */
        .divider{
            border-top: 2px solid var(--primary-light);
            margin: 20px 0 0 0;
            padding-top: 20px;
            background: linear-gradient(to bottom, var(--primary-light) 0%, transparent 100%);
            background-size: 100% 1px;
            background-repeat: no-repeat;
        }

        /* Improved row layout with better spacing */
        .row{
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
            gap: 16px;
            padding: 8px 0;
        }
        .row:last-child{
            margin-bottom: 0;
            padding-top: 12px;
            border-top: 1px dashed var(--border);
        }

        .label{
            color: var(--muted);
            font-weight: 600;
            font-size: 14px;
        }
        .value{
            color: var(--accent);
            font-weight: 700;
            font-size: 15px;
        }

        /* Enhanced total with highlight background */
        .total{
            font-size: 18px;
            color: var(--primary);
            font-weight: 800;
        }
        .row:last-child{
            background: var(--primary-light);
            padding: 12px 16px;
            border-radius: 8px;
            margin-top: 8px;
            border: none;
        }

        /* Enhanced print styles */
        @page{
            margin: 15mm;
            size: A4;
        }
        @media print{
            body{
                background: #fff;
                font-size: 12pt;
            }
            .container{
                margin: 0 auto;
                padding: 0;
            }
            .card{
                box-shadow: none;
                border: 2px solid var(--border);
                margin-bottom: 20mm;
                page-break-after: always;
            }
            .card:hover{
                transform: none;
            }
            h1::after{
                background: var(--accent);
            }
        }

        /* Responsive improvements */
        @media (max-width: 768px){
            .container{
                margin: 24px auto;
                padding: 0 16px;
            }
            h1{
                font-size: 26px;
                margin-bottom: 24px;
            }
            .card{
                padding: 20px;
                border-radius: 12px;
            }
            .ticket-header{
                flex-direction: column;
                gap: 12px;
            }
            .ticket-number{
                text-align: left;
                align-self: flex-start;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Facturas de Tickets</h1>

    @foreach ($tickets as $ticket)

        <div class="card">
            <div class="ticket-header">
                <div>
                    <h2 class="ticket-title">Reserva Electrónica</h2>
                    <p class="ticket-meta">Fecha: {{ $ticket->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="ticket-number">
                    Ticket #{{ $ticket->token }}
                </div>
            </div>

            {{-- Datos del vuelo --}}
            <div class="grid">
                <div>
                    <p class="field-label">Origen</p>
                    <p class="field-value">{{ $ticket->flight->origin->origin }}</p>
                </div>
                <div>
                    <p class="field-label">Destino</p>
                    <p class="field-value">{{ $ticket->flight->destinie->destinie }}</p>
                </div>
                <div>
                    <p class="field-label">Cantidad de pasajeros</p>
                    <p class="field-value">{{ $ticket->cantPasajeros + 1 }}</p>
                </div>
                <div>
                    <p class="field-label">Método de pago</p>
                    <p class="field-value">{{ $ticket->user_payer->pays->first()->metodoPago }}</p>
                </div>
            </div>

            {{-- Detalles de costos --}}
            <div class="divider">
                <div class="row">
                    <span class="label">Valor por puesto</span>
                    <span class="value">
                        ${{ number_format($ticket->flight->positionValue ?? 0, 0, ',', '.') }}
                    </span>
                </div>
                <div class="row">
                    <span class="label total">Valor total</span>
                    <span class="value total">
                        ${{ number_format($ticket->user_payer->pays->first()->total ?? 0, 0, ',', '.') * ($ticket->cantPasajeros + 1) }}
                    </span>
                </div>
            </div>
        </div>

    @endforeach
</div>

</body>
</html>
