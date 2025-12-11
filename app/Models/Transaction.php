<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // TAMBAHKAN INI (Daftar kolom yang boleh diisi)
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'receiver_name',
        'address',
        'phone',
        'note',
        'payment_proof'
    ];

    // Relasi yang sudah kamu buat sebelumnya (biarkan saja)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
