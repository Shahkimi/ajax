<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gcuti extends Model
{
    use HasFactory;

    protected $fillable = [
        'gkcuti_id',
        'jenis_cuti',
    ];

    public function gkcuti()
    {
        return $this->belongsTo(Gkcuti::class);
    }
}
