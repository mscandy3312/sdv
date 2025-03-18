<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'price',
        'stock',
        'category_id',
        'description',
        'image',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    // Relación con la categoría
    public function categoria()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relación con los detalles de venta
    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    // Relación con las ventas a través de los detalles
    public function ventas()
    {
        return $this->hasManyThrough(
            Sale::class,
            SaleDetail::class,
            'product_id', // Llave foránea en sale_details
            'id', // Llave primaria en sales
            'id', // Llave primaria en products
            'sale_id' // Llave foránea en sale_details que apunta a sales
        );
    }

    // Accessor para el total vendido
    public function getTotalVendidoAttribute()
    {
        return $this->saleDetails->sum('quantity');
    }

    // Accessor para el total en ventas
    public function getTotalVentasAttribute()
    {
        return $this->saleDetails->sum('subtotal');
    }
} 