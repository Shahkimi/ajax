<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $primaryKey = 'kod_unit';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['kod_unit', 'kod_bahagian'];

    public function bahagian()
    {
        return $this->belongsTo(Bahagian::class, 'kod_bahagian', 'kod_bahagian');
    }
}
