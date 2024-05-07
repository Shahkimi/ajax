<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gelaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_gelaran',
        'desc_gelaran',
    ];
}
