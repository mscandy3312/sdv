<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de {{ ucfirst($tipo) }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
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
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Reporte de {{ ucfirst($tipo) }}</h2>
        <p>Período: {{ date('d/m/Y', strtotime($fecha_inicio)) }} - {{ date('d/m/Y', strtotime($fecha_fin)) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                @switch($tipo)
                    @case('ventas')
                        <th>Fecha</th>
                        <th>Total Ventas</th>
                        <th>Monto Total</th>
                        @break
                    @case('productos')
                        <th>Producto</th>
                        <th>Cantidad Vendida</th>
                        <th>Monto Total</th>
                        @break
                    @case('categorias')
                        <th>Categoría</th>
                        <th>Total Ventas</th>
                        <th>Monto Total</th>
                        @break
                @endswitch
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    @switch($tipo)
                        @case('ventas')
                            <td>{{ $item->periodo }}</td>
                            <td>{{ $item->total_ventas }}</td>
                            <td>${{ number_format($item->total_monto, 2) }}</td>
                            @break
                        @case('productos')
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->total_vendido }}</td>
                            <td>${{ number_format($item->total_monto, 2) }}</td>
                            @break
                        @case('categorias')
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->total_ventas }}</td>
                            <td>${{ number_format($item->total_monto, 2) }}</td>
                            @break
                    @endswitch
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>{{ config('app.name') }} - Generado el {{ date('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html> 