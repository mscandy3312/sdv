<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .details {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>¡Gracias por su compra!</h2>
        </div>

        <div class="details">
            <p>Estimado(a) cliente,</p>
            <p>Su compra ha sido procesada exitosamente. Los detalles de su compra son:</p>
            <ul>
                <li>Número de Venta: #{{ str_pad($venta->id, 6, '0', STR_PAD_LEFT) }}</li>
                <li>Fecha: {{ $venta->created_at->format('d/m/Y H:i') }}</li>
                <li>Total: ${{ number_format($venta->total, 2) }}</li>
            </ul>
            <p>Adjuntamos el comprobante de su compra en formato PDF.</p>
        </div>

        <div class="footer">
            <p>{{ config('app.name') }} - {{ date('Y') }}</p>
        </div>
    </div>
</body>
</html> 