<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;

class BelumMenikah extends Model
{
    use Encryptable;
    protected $table = 'belum_menikah';
    protected $fillable = [
        'nama',
        'tempat_lahir',
        'ttl',
        'nik',
        'alamat',
        'keperluan',
        'pengantar_rt',
        'status_perkawinan',
        'no_hp',
        'ktp',
        'status',
        'kk'
    ];

    protected $encryptable = [
        'nama',
        'tempat_lahir',
        'nik',
        'alamat',
        'keperluan',
        'status_perkawinan',
        'no_hp',
        'ktp',
        'kk',
        'pengantar_rt',
    ];

    protected $casts = [
        'ttl' => 'date'
    ];
}
