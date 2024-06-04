<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gkcuti extends Model
{
    use HasFactory;
    protected $fillable = [
        'kategori_cuti',
    ];

    public function gcutis()
    {
        return $this->hasMany(Gcuti::class);
    }
}
