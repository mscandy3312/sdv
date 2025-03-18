<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte - {{ ucfirst($tipo) }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            padding: 20px;
        }
        h1 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 10px;
        }
        p {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <h1>Reporte de {{ ucfirst($tipo) }}</h1>
    <p>Fecha: {{ $fecha }}</p>

    @switch($tipo)
        @case('ventas')
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th class="text-right">Total Ventas</th>
                        <th class="text-right">Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['tendencia_ventas'] as $venta)
                        <tr>
                            <td>{{ $venta['fecha'] }}</td>
                            <td class="text-right">{{ $venta['total_ventas'] }}</td>
                            <td class="text-right">${{ number_format($venta['total_monto'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @break

        @case('productos')
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th class="text-right">Total Vendido</th>
                        <th class="text-right">Total Ventas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['mejores_productos'] as $producto)
                        <tr>
                            <td>{{ $producto['nombre'] }}</td>
                            <td class="text-right">{{ $producto['total_vendido'] }}</td>
                            <td class="text-right">${{ number_format($producto['total_ventas'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @break

        @case('categorias')
            <table>
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th class="text-right">Total Ventas</th>
                        <th class="text-right">Monto Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['top_categorias'] as $categoria)
                        <tr>
                            <td>{{ $categoria['nombre'] }}</td>
                            <td class="text-right">{{ $categoria['total_ventas'] }}</td>
                            <td class="text-right">${{ number_format($categoria['total_monto'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @break

        @case('stock')
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th class="text-right">Stock Actual</th>
                        <th class="text-right">Stock Mínimo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['productos_bajos'] as $producto)
                        <tr>
                            <td>{{ $producto['nombre'] }}</td>
                            <td class="text-right">{{ $producto['stock'] }}</td>
                            <td class="text-right">{{ $producto['stock_minimo'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @break

        @default
            <p>Tipo de reporte no válido</p>
    @endswitch
</body>
</html> 