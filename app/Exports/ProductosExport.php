<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductosExport implements FromCollection, WithHeadings, WithMapping
{
    protected $productos;

    public function __construct($productos)
    {
        $this->productos = $productos;
    }

    public function collection()
    {
        return $this->productos;
    }

    public function headings(): array
    {
        return [
            'Código',
            'Nombre',
            'Categoría',
            'Precio',
            'Stock',
            'Estado'
        ];
    }

    public function map($producto): array
    {
        return [
            $producto->code,
            $producto->name,
            $producto->categoria ? $producto->categoria->name : 'Sin categoría',
            number_format($producto->price, 2),
            $producto->stock,
            $producto->status ? 'Activo' : 'Inactivo'
        ];
    }
} 