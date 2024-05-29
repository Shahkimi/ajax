<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gcuti extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_cuti',
        'jenis_cuti',
    ];
}
