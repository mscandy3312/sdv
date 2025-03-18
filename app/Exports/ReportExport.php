<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection, WithHeadings
{
    protected $data;
    protected $tipo;

    public function __construct($data, $tipo)
    {
        $this->data = $data;
        $this->tipo = $tipo;
    }

    public function collection()
    {
        return $this->data->map(function($item) {
            return match($this->tipo) {
                'ventas' => [$item->periodo, $item->total_ventas, $item->total_monto],
                'productos' => [$item->nombre, $item->total_vendido, $item->total_monto],
                'categorias' => [$item->nombre, $item->total_ventas, $item->total_monto],
                default => [],
            };
        });
    }

    public function headings(): array
    {
        return match($this->tipo) {
            'ventas' => ['Fecha', 'Total Ventas', 'Monto Total'],
            'productos' => ['Producto', 'Cantidad Vendida', 'Monto Total'],
            'categorias' => ['Categoría', 'Total Ventas', 'Monto Total'],
            default => ['No hay datos'],
        };
    }
} 