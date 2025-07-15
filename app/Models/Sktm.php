<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;

class Sktm extends Model
{
    use Encryptable;
    protected $table = 'sktm';
    protected $fillable = [
        'nama',
        'tempat_lahir',
        'ttl',
        'nik',
        'alamat',
        'keperluan',
        'status_perkawinan',
        'nama_anak',
        'pengantar_rt',
        'ktp',
        'status',
        'no_hp',
        'kk'
    ];

    protected $encryptable = [
        'nama',
        'tempat_lahir',
        'nik',
        'alamat',
        'keperluan',
        'status_perkawinan',
        'nama_anak',
        'pengantar_rt',
        'ktp',
        'no_hp',
        'kk'
    ];

    protected $casts = [
        'ttl' => 'date'
    ];
}
