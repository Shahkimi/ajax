<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bangsa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bangsa',
        'desc_bangsa',
    ];
}
