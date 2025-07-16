<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;

class Kelahiran extends Model
{
    use Encryptable;
    protected $table = 'kelahiran';
    protected $fillable = [
        'nama',
        'nik',
        'ttl',
        'tempat_lahir',
        'alamat',
        'status_perkawinan',
        'no_hp',
        'keperluan',
        'status',
        'surat_keterangan_bidan',
        'pengantar_rt',
        'ktp',
        'kk'
    ];

    protected $encryptable = [
        'nama',
        'nik',
        'tempat_lahir',
        'alamat',
        'status_perkawinan',
        'no_hp',
        'keperluan',
        'surat_keterangan_bidan',
        'pengantar_rt',
        'ktp',
        'kk'
    ];

    protected $casts = [
        'ttl' => 'date'
    ];
}
