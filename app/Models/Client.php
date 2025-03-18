<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'last_name',
        'address',
        'phone',
        'email',
        'comments',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    // Relación con las ventas
    public function ventas()
    {
        return $this->hasMany(Sale::class, 'clients_id');
    }

    // Accessor para el nombre completo
    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->last_name}";
    }

    // Accessor para el total de compras
    public function getTotalComprasAttribute()
    {
        return $this->ventas->sum('total');
    }

    // Accessor para el número de compras
    public function getComprasCountAttribute()
    {
        return $this->ventas->count();
    }

    // Accessor para la última compra
    public function getUltimaCompraAttribute()
    {
        return $this->ventas->sortByDesc('created_at')->first();
    }
} 