<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bahagian extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ptj_id',
        'nama_bahagian',
    ];

    public function ptj()
    {
        return $this->belongsTo(Ptj::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}
