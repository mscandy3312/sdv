<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'code',
        'description',
        'price',
        'stock',
        'status',
        'category_id',
        'image'
    ];

    protected $casts = [
        'price' => 'float',
        'stock' => 'integer',
        'status' => 'boolean'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'category_id');
    }

    public function detalles()
    {
        return $this->hasMany(VentaDetalle::class, 'product_id');
    }

    public function ventas()
    {
        return $this->belongsToMany(Venta::class, 'sale_details', 'product_id', 'sale_id')
                    ->withPivot('quantity', 'unit_price', 'subtotal')
                    ->withTimestamps();
    }

    public function ventaDetalles()
    {
        return $this->hasMany(VentaDetalle::class, 'product_id');
    }

    // Accessors
    public function getNombreAttribute()
    {
        return $this->name;
    }

    public function getDescripcionAttribute()
    {
        return $this->description;
    }

    public function getPrecioAttribute()
    {
        return $this->price;
    }

    public function getImagenAttribute()
    {
        return $this->image;
    }

    // Mutators
    public function setNombreAttribute($value)
    {
        $this->attributes['name'] = $value;
    }

    public function setDescripcionAttribute($value)
    {
        $this->attributes['description'] = $value;
    }

    public function setPrecioAttribute($value)
    {
        $this->attributes['price'] = $value;
    }

    public function setImagenAttribute($value)
    {
        $this->attributes['image'] = $value;
    }
}

