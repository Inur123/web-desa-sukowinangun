<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;

class Penghasilan extends Model
{
    use Encryptable;

    protected $table = 'penghasilan';

    protected $fillable = [
        'nama',
        'nik',
        'tempat_lahir',
        'ttl',
        'alamat',
        'status_perkawinan',
        'no_hp',
        'penghasilan_per_bulan',
        'keperluan',
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
        'penghasilan_per_bulan',
        'keperluan',
        'kk',
        'ktp',
        'pengantar_rt',
    ];

    protected $casts = [
        'ttl' => 'date',
    ];
}
