<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;

class LainnyaFile extends Model
{
    use Encryptable;

    protected $table = 'lainnya_files';

    protected $fillable = [
        'lainnya_id',
        'nama',
        'file'
    ];

    protected $encryptable = [
        'nama',
        'file'
    ];

    // Relasi ke tabel lainnya
    public function lainnya()
    {
        return $this->belongsTo(Lainnya::class, 'lainnya_id');
    }
}
