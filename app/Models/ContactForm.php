<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    protected $table = 'contact_forms';
    protected $fillable = [
        'nama_lengkap',
        'no_telepon',
        'email',
        'jenis_kebutuhan',
        'pesan'
    ];
}
