<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Venta #{{ str_pad($venta->id, 6, '0', STR_PAD_LEFT) }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .company-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .venta-info {
            margin-bottom: 20px;
        }
        .venta-info p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        .totales {
            float: right;
            width: 300px;
        }
        .totales p {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
            padding: 5px 0;
        }
        .total-final {
            font-weight: bold;
            border-top: 2px solid #000;
            padding-top: 5px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: #666;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="company-name">{{ config('app.name') }}</div>
        <p>Sistema de Ventas</p>
    </div>

    <div class="venta-info">
        <p><strong>Venta #:</strong> {{ str_pad($venta->id, 6, '0', STR_PAD_LEFT) }}</p>
        <p><strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>Cliente:</strong> {{ $venta->cliente }}</p>
        <p><strong>Método de Pago:</strong> {{ ucfirst($venta->metodo_pago) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio Unit.</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venta->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>${{ number_format($detalle->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totales">
        <p>
            <span>Subtotal:</span>
            <span>${{ number_format($venta->subtotal, 2) }}</span>
        </p>
        <p>
            <span>IVA (16%):</span>
            <span>${{ number_format($venta->iva, 2) }}</span>
        </p>
        <p class="total-final">
            <span>Total:</span>
            <span>${{ number_format($venta->total, 2) }}</span>
        </p>
    </div>

    <div class="footer">
        <p>Gracias por su compra</p>
        <p>{{ config('app.name') }} - {{ date('Y') }}</p>
    </div>
</body>
</html> 