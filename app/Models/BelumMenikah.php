<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BelumMenikah extends Model
{
    protected $table = 'belum_menikah';
    protected $fillable = [
        'nama',
        'tempat_lahir',
        'ttl',
        'nik',
        'alamat',
        'keperluan',
        'pengantar_rt',
        'ktp',
        'status',
        'no_hp',
        'kk'
    ];

    protected $casts = [
        'ttl' => 'date'
    ];
}
