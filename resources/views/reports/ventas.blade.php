<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte de Ventas</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            color: #2d3748;
            margin-bottom: 30px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
        }
        .header img {
            max-width: 150px;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #1a202c;
            font-size: 24px;
        }
        .header p {
            color: #718096;
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 14px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }
        th {
            background-color: #4a5568;
            color: white;
            font-weight: bold;
            padding: 12px;
            text-align: left;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
        }
        tr:nth-child(even) {
            background-color: #f7fafc;
        }
        .total-row {
            background-color: #edf2f7;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #718096;
            font-size: 12px;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Ventas</h1>
        <p>Fecha: {{ $fecha }}</p>
        <p>Total de registros: {{ $datos->count() }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th style="text-align: right">Total</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($datos as $venta)
                @php $total += $venta->total; @endphp
                <tr>
                    <td>{{ $venta->code }}</td>
                    <td>{{ $venta->client->name }}</td>
                    <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                    <td style="text-align: right">${{ number_format($venta->total, 2) }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="3">Total</td>
                <td style="text-align: right">${{ number_format($total, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Reporte generado el {{ date('d/m/Y H:i:s') }}</p>
        <p>Sistema de Ventas</p>
    </div>
</body>
</html> 