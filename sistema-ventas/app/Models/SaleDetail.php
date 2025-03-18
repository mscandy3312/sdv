<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;
use App\Models\Product;

class SaleDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'price',
        'subtotal'
    ];

    // Relación con venta
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    // Relación con producto
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
