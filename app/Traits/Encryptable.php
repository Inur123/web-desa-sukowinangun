<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Http\UploadedFile;

trait Encryptable
{
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->encryptable) && !is_null($value)) {
            try {
                if ($this->isFileField($key)) {
                    return $this->handleEncryptedFile($value);
                }
                return Crypt::decryptString($value);
            } catch (Exception $e) {
                return $value; // fallback ke nilai asli jika gagal dekripsi
            }
        }

        return $value;
    }

    public function setAttribute($key, $value)
    {
        // Abaikan enkripsi jika bukan field terenkripsi
        if (!in_array($key, $this->encryptable) || is_null($value)) {
            parent::setAttribute($key, $value);
            return;
        }

        if ($this->isFileUpload($key, $value)) {
            $value = $this->encryptUploadedFile($value, $key); // ← kirim nama field
        } else {
            $value = Crypt::encryptString($value);
        }

        parent::setAttribute($key, $value);
    }

    protected function isFileField($key)
    {
        return in_array($key, ['pengantar_rt', 'ktp']);
    }

    protected function isFileUpload($key, $value)
    {
        return $this->isFileField($key) && $value instanceof UploadedFile;
    }

    protected function handleEncryptedFile($path)
    {
        try {
            $encryptedContent = Storage::disk('public')->get($path);
            return Crypt::decryptString($encryptedContent);
        } catch (Exception $e) {
            return null;
        }
    }

    protected function encryptUploadedFile(UploadedFile $file, $field)
    {
        try {
            $fileContent = file_get_contents($file->path());
            $encryptedContent = Crypt::encryptString($fileContent);

            $folder = 'sku/' . $field;
            $fileName = 'encrypted_' . md5(time() . $file->getClientOriginalName()) . '.enc';
            $filePath = $folder . '/' . $fileName;

            Storage::disk('public')->put($filePath, $encryptedContent);

            return $filePath;
        } catch (Exception $e) {
            throw new \RuntimeException('Gagal menyimpan file terenkripsi: ' . $e->getMessage());
        }
    }
}
