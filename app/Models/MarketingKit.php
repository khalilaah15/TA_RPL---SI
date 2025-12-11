<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketingKit extends Model
{
    protected $fillable = [
        'title',
        'caption',
        'image_path',
    ];
}