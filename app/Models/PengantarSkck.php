<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;

class PengantarSkck extends Model
{
     use Encryptable;

    protected $table = 'pengantar_skck';

    protected $fillable = [
        'nama',
        'nik',
        'tempat_lahir',
        'ttl',
        'alamat',
        'status',
        'no_hp',
        'keperluan',
        'status_perkawinan',
        'kk',
        'ktp',
        'pengantar_rt',
    ];

    protected $encryptable = [
        'nama',
        'nik',
        'tempat_lahir',
        'alamat',
        'keperluan',
        'pengantar_rt',
        'status_perkawinan',
        'ktp',
        'no_hp',
        'kk'
    ];

    protected $casts = [
        'ttl' => 'date'
    ];
}

