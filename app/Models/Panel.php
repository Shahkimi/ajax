<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pengurusi',
        'mpm_pengurusi',
        'nama_panel',
        'nama_panel2',
        'mpm_panel2',
        'jawatan_panel2',
        'tajuk_panel2',
        'penyemak',
        'jawatan_penyemak',
    ];
}
