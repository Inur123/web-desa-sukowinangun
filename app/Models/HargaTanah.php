<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;

class HargaTanah extends Model
{
    use Encryptable;

    protected $table = 'harga_tanah';

    protected $fillable = [
        'nama',
        'nik',
        'tempat_lahir',
        'ttl',
        'alamat',
        'alamat_tanah',
        'harga_per_meter',
        'status_perkawinan',
        'no_hp',
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
        'alamat_tanah',
        'harga_per_meter',
        'status_perkawinan',
        'no_hp',
        'keperluan',
        'kk',
        'ktp',
        'pengantar_rt',
    ];

    protected $casts = [
        'ttl' => 'date',
    ];
}
