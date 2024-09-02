<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hukuman extends Model
{
    use HasFactory;

    protected $fillable = [
        'kod_hukuman',
        'desc_hukuman',
    ];
}
