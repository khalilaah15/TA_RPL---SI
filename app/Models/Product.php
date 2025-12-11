<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Jika ada
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Tambahkan bagian ini:
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];
}

