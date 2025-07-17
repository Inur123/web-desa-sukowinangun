<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;

class Lainnya extends Model
{
    use Encryptable;

    protected $table = 'lainnya';

    protected $fillable = [
        'nama',
        'nik',
        'ttl',
        'tempat_lahir',
        'alamat',
        'status_perkawinan',
        'keperluan',
        'status',
        'no_hp'
    ];

    protected $encryptable = [
        'nama',
        'nik',
        'tempat_lahir',
        'alamat',
        'status_perkawinan',
        'keperluan',
        'no_hp'
    ];

    protected $casts = [
        'ttl' => 'date'
    ];

    public function files()
    {
        return $this->hasMany(LainnyaFile::class);
    }
}
