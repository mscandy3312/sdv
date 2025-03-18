<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['name', 'description'];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'category_id');
    }

    public function getNombreAttribute()
    {
        return $this->name;
    }

    public function getDescripcionAttribute()
    {
        return $this->description;
    }

    public function setNombreAttribute($value)
    {
        $this->attributes['name'] = $value;
    }

    public function setDescripcionAttribute($value)
    {
        $this->attributes['description'] = $value;
    }
} 