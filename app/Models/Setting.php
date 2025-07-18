<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use Encryptable;

    protected $fillable = ['key', 'value'];
    protected $encryptable = ['value']; // Kolom yang akan dienkripsi

    // Method helper untuk memudahkan akses
    public static function getValue($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    // Method untuk update/create dengan enkripsi otomatis
    public static function updateOrCreateEncrypted($key, $value)
    {
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value] // Akan dienkripsi otomatis oleh trait
        );
    }
}
