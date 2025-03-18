<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VentasExport implements FromCollection, WithHeadings, WithMapping
{
    protected $ventas;

    public function __construct($ventas)
    {
        $this->ventas = $ventas;
    }

    public function collection()
    {
        return $this->ventas;
    }

    public function headings(): array
    {
        return [
            'Código',
            'Cliente',
            'Fecha',
            'Total',
            'Estado'
        ];
    }

    public function map($venta): array
    {
        return [
            $venta->code,
            $venta->client->name,
            $venta->created_at->format('d/m/Y H:i'),
            number_format($venta->total, 2),
            $venta->status
        ];
    }
} 