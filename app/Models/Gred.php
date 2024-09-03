<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gred extends Model
{
    use HasFactory;
    protected $fillable = [
        'kod_gred',
        'desc_gred',
    ];
}
