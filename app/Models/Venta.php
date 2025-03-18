<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $fillable = [
        'cliente',
        'total',
        'estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'sale_details', 'sale_id', 'product_id')
            ->withPivot(['quantity', 'price', 'subtotal'])
            ->withTimestamps();
    }

    public function detalles()
    {
        return $this->hasMany(VentaDetalle::class, 'sale_id');
    }
}


