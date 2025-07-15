<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;

class Domisili extends Model
{
    use Encryptable;
    protected $table = 'domisili';
    protected $fillable = [
            'nama',
            'nik',
            'ttl',
            'tempat_lahir',
            'alamat',
            'alamat_domisili',
            'status_perkawinan',
            'keperluan',
            'pengantar_rt',
            'ktp',
            'status',
            'no_hp',
            'kk'
        ];

    protected $encryptable = [
        'nama',
        'nik',
        'tempat_lahir',
        'alamat',
        'alamat_domisili',
        'status_perkawinan',
        'keperluan',
        'pengantar_rt',
        'ktp',
        'no_hp',
        'kk'
    ];

    protected $casts = [
        'ttl' => 'date'
    ];
}
