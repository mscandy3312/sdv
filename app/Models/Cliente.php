<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clients';
    
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function ventas()
    {
        return $this->hasMany(Sale::class, 'clients_id');
    }
}
