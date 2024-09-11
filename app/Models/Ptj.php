<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ptj extends Model
{
    use HasFactory;

    protected $fillable = [
        'kod_ptj',
        'desc_ptj',
        'ketua_ptj',
        'alamat_ptj',
    ];

    public function bahagians()
    {
        return $this->hasMany(Bahagian::class);
    }
}
