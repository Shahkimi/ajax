<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kesalahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kod_kesalahan',
        'desc_kesalahan',
    ];
}
