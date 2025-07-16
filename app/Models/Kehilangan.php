<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;

class Kehilangan extends Model
{
    use Encryptable;
    protected $table = 'kehilangan';
    protected $fillable = [
        'nama',
        'nik',
        'ttl',
        'tempat_lahir',
        'alamat',
        'status_perkawinan',
        'no_hp',
        'surat_yang_hilang',
        'keperluan',
        'pengantar_rt',
        'ktp',
        'status',
        'kk'
    ];

    protected $encryptable = [
        'nama',
        'nik',
        'tempat_lahir',
        'alamat',
        'status_perkawinan',
        'no_hp',
        'surat_yang_hilang',
        'keperluan',
        'pengantar_rt',
        'ktp',
        'kk'
    ];

    protected $casts = [
        'ttl' => 'date'
    ];
}
