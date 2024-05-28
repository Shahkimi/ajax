<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gkategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategori',
        'desc_kategori',
    ];
}
