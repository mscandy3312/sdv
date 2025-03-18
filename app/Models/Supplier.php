<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'Legal Compliance',
        'General Supplier Profile',
        'Price',
        'Technical Capability',
        'Technology and Infrastructure',
        'Performance and Service Level'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
} 