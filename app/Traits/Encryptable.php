<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Exception;

trait Encryptable
{
    /**
     * Override default getAttribute
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->encryptable ?? []) && !is_null($value)) {
            try {
                if ($this->isFileField($key)) {
                    return $value; // File: return path saja, decrypt manual saat ditampilkan
                }
                return Crypt::decryptString($value); // Teks biasa: decryptString
            } catch (Exception $e) {
                return $value; // fallback jika gagal decrypt
            }
        }

        return $value;
    }

    /**
     * Override default setAttribute
     */
    public function setAttribute($key, $value)
    {
        if (!in_array($key, $this->encryptable ?? []) || is_null($value)) {
            parent::setAttribute($key, $value);
            return;
        }

        if ($this->isFileUpload($key, $value)) {
            $value = $this->encryptUploadedFile($value, $key); // Enkripsi file upload
        } else {
            $value = Crypt::encryptString($value); // Enkripsi teks biasa
        }

        parent::setAttribute($key, $value);
    }

    /**
     * Cek apakah ini field file (bisa kamu ubah sesuai field lain)
     */
    protected function isFileField($key)
    {
        return in_array($key, ['pengantar_rt', 'ktp', 'file_surat']);
    }

    /**
     * Cek apakah file upload valid untuk dienkripsi
     */
    protected function isFileUpload($key, $value)
    {
        return $this->isFileField($key) && $value instanceof UploadedFile;
    }

    /**
     * Fungsi khusus untuk mendekripsi isi file dari path di storage
     */
    public function handleEncryptedFile($path)
    {
        try {
            $encryptedContent = Storage::disk('public')->get($path);
            return Crypt::decrypt($encryptedContent); // binary-safe decrypt
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Fungsi menyimpan file terenkripsi ke storage dan kembalikan path
     */
   protected function encryptUploadedFile(UploadedFile $file, $field)
{
    try {
        $fileContent = file_get_contents($file->getRealPath());
        $encryptedContent = Crypt::encrypt($fileContent); // binary-safe encrypt

        $folder = $this->getFolderByField($field);
        $extension = $file->getClientOriginalExtension(); // Ambil ekstensi asli
        $fileName = 'encrypted_' . md5(time() . $file->getClientOriginalName()) . '.' . $extension . '.enc';
        $filePath = $folder . '/' . $fileName;

        Storage::disk('public')->put($filePath, $encryptedContent);

        return $filePath;
    } catch (Exception $e) {
        throw new \RuntimeException('Gagal menyimpan file terenkripsi: ' . $e->getMessage());
    }
}


    /**
     * Folder tujuan file sesuai nama field
     */
    protected function getFolderByField($field)
    {
        return match ($field) {
            'ktp' => 'sku/ktp',
            'pengantar_rt' => 'sku/pengantar_rt',
            'file_surat' => 'arsip/file_surat',
            default => 'uploads',
        };
    }
}
