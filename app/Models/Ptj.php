<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ptj extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ptjs';

    protected $fillable = [
        'nama_ptj',
        'kod_ptj',
        'alamat',
        'pengarah',
    ];

    public function bahagians()
    {
        return $this->hasMany(Bahagian::class);
    }
}
