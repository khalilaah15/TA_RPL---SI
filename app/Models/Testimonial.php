<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['user_id', 'rating', 'content'];

    // Relasi ke User (biar tahu siapa yang nulis)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
