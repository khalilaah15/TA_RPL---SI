<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    // Pastikan bagian ini ada!
    protected $fillable = [
        'transaction_id', 
        'product_id', 
        'quantity', 
        'price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}