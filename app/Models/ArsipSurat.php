<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;

class ArsipSurat extends Model
{
    use Encryptable;

    protected $fillable = [
        'nomor_surat',
        'pengirim_penerima',
        'tanggal',
        'jenis',
        'file_surat',
        'deskripsi',
    ];

    protected $encryptable = [
        'nomor_surat',
        'pengirim_penerima',
        'file_surat',
        'deskripsi',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
