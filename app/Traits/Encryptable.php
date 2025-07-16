<?php

namespace App\Traits;

use Exception;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;



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
            $value = $this->processAndEncryptFile($value, $key);
        } else {
            $value = Crypt::encryptString($value); // Enkripsi teks biasa
        }

        parent::setAttribute($key, $value);
    }

    /**
     * Cek apakah ini field file
     */
    protected function isFileField($key)
    {
        return in_array($key, ['pengantar_rt', 'ktp', 'file_surat', 'kk','surat_keterangan_bidan']);
    }

    /**
     * Cek apakah file upload valid untuk dienkripsi
     */
    protected function isFileUpload($key, $value)
    {
        return $this->isFileField($key) && ($value instanceof UploadedFile || $this->isBase64Image($value));
    }

    /**
     * Cek apakah value berupa base64 image
     */
    protected function isBase64Image($value)
    {
        return is_string($value) && preg_match('/^data:image\/(\w+);base64,/', $value);
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
     * Proses dan enkripsi file yang diupload (baik file maupun dari kamera)
     */
    protected function processAndEncryptFile($file, $field)
    {
        try {
            // Jika file berasal dari kamera (base64)
            if ($this->isBase64Image($file)) {
                $imageData = $this->processBase64Image($file);
                $fileContent = $imageData['content'];
                $extension = $imageData['extension'];
            }
            // Jika file adalah UploadedFile biasa
            elseif ($file instanceof UploadedFile) {
                $fileContent = $this->processUploadedFile($file);
                $extension = $file->getClientOriginalExtension();
            } else {
                throw new \RuntimeException('Format file tidak didukung');
            }

            // Enkripsi konten file
            $encryptedContent = Crypt::encrypt($fileContent);

            // Simpan ke storage
            $folder = $this->getFolderByField($field);
            $fileName = 'encrypted_' . Str::uuid() . '.' . $extension . '.enc';
            $filePath = $folder . '/' . $fileName;

            Storage::disk('public')->put($filePath, $encryptedContent);

            return $filePath;
        } catch (Exception $e) {
            throw new \RuntimeException('Gagal memproses file: ' . $e->getMessage());
        }
    }

    /**
     * Proses file upload biasa
     */
    protected function processUploadedFile(UploadedFile $file)
    {
        $extension = strtolower($file->getClientOriginalExtension());

        // Optimasi gambar jika format gambar
        if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            $image = Image::make($file)
                ->orientate() // Perbaiki orientasi
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode($extension, 75); // Kompresi kualitas 75%

            return $image->getEncoded();
        }

        return file_get_contents($file->getRealPath());
    }

    /**
     * Proses gambar dari kamera (base64)
     */
    protected function processBase64Image($base64)
    {
        $matches = [];
        preg_match('/^data:image\/(\w+);base64,/', $base64, $matches);
        $extension = $matches[1] ?? 'jpg';

        $imageData = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $base64));

        // Optimasi gambar
        $optimizedImage = Image::make($imageData)
            ->orientate()
            ->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->encode($extension, 75);

        return [
            'content' => $optimizedImage->getEncoded(),
            'extension' => $extension
        ];
    }

    /**
     * Folder tujuan file sesuai nama field
     */
    protected function getFolderByField($field)
    {
        $prefix = strtolower(class_basename($this)); // contoh: SKU, SKTM, dst
        return match ($field) {
            'ktp' => "$prefix/ktp",
            'pengantar_rt' => "$prefix/pengantar_rt",
            'kk' => "$prefix/kk",
            'surat_keterangan_bidan' => "$prefix/surat_keterangan_bidan",
            'file_surat' => 'arsip/file_surat',
            default => "$prefix/uploads",
        };
    }
}
