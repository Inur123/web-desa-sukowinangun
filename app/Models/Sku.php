<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    use Encryptable;

    protected $fillable = [
        'nama',
        'tempat_lahir',
        'ttl',
        'nik',
        'alamat',
        'status_perkawinan',
        'nama_usaha',
        'alamat_usaha',
        'keperluan',
        'pengantar_rt',
        'ktp'
    ];

    protected $encryptable = [
        'nama',
        'tempat_lahir',
        'nik',
        'alamat',
        'status_perkawinan',
        'nama_usaha',
        'alamat_usaha',
        'keperluan',
        'pengantar_rt',
        'ktp'
    ];

    protected $casts = [
        'ttl' => 'date'
    ];
}
