<?php

namespace App\Observers;

use App\Models\Producto;

class ProductoObserver
{
    public function creating(Producto $producto)
    {
        if (empty($producto->code)) {
            $producto->code = $this->generateUniqueCode();
        }
    }

    private function generateUniqueCode()
    {
        do {
            $code = 'PRD-' . strtoupper(uniqid());
        } while (Producto::where('code', $code)->exists());

        return $code;
    }
} 