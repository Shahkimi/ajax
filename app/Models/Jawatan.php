<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kod_jawatan',
        'desc_jawatan',
    ];
}
