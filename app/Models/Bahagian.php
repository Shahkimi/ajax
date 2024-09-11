<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahagian extends Model
{
    protected $fillable = [
        'ptj_id',
        'desc_bahagian',
    ];

    public function ptj()
    {
        return $this->belongsTo(PTJ::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}
