<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahagian extends Model
{
    protected $primaryKey = 'kod_bahagian';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['kod_bahagian', 'kod_ptj'];

    public function ptj()
    {
        return $this->belongsTo(Ptj::class, 'kod_ptj', 'kod_ptj');
    }

    public function units()
    {
        return $this->hasMany(Unit::class, 'kod_bahagian', 'kod_bahagian');
    }
}
