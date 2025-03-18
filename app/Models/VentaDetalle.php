<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    protected $table = 'sale_details';
    
    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'unit_price',
        'subtotal'
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'sale_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'product_id');
    }
} 