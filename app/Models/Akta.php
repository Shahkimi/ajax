<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akta extends Model
{
    use HasFactory;

    protected $fillable = [
        'kod_akta',
        'desc_akta',
    ];
}
