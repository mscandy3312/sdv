<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    // Definir constantes para los estados
    const STATUS_PENDING = 'PENDING';
    const STATUS_PAID = 'PAID';
    const STATUS_CANCELLED = 'CANCELLED';

    protected $fillable = [
        'code',
        'clients_id',
        'user_id',
        'total',
        'tax',
        'status'
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'tax' => 'decimal:2',
        'clients_id' => 'integer'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'clients_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(SaleDetail::class);
    }

    // Helper para verificar el estado
    public function isPaid()
    {
        return $this->status === self::STATUS_PAID;
    }
}
