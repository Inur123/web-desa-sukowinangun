<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
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
    'ktp',
];
}
