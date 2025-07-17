<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;

class Kematian extends Model
{
    use Encryptable;

    protected $table = 'kematian';

    protected $fillable = [
        'nama',
        'nik',
        'tempat_lahir',
        'ttl',
        'alamat',
        'tanggal_meninggal',
        'status_perkawinan',
        'no_hp',
        'kk',
        'ktp',
        'pengantar_rt',
        'status',
    ];

    protected $encryptable = [
        'nama',
        'nik',
        'tempat_lahir',
        'alamat',
        'status_perkawinan',
        'no_hp',
        'kk',
        'ktp',
        'pengantar_rt',
    ];

    protected $casts = [
        'ttl' => 'date',
        'tanggal_meninggal' => 'date',
    ];
}
