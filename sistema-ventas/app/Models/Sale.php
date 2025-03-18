<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\User;
use App\Models\SaleDetail;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'customer_id',
        'user_id',
        'total',
        'tax',
        'status'
    ];

    // Relación con cliente
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con detalles de venta
    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
