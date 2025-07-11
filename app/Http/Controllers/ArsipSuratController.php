<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ArsipSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ArsipSuratController extends Controller
{
   public function index()
{
    $arsipList = ArsipSurat::latest()->get();
    return view('admin.arsip_surat.index', compact('arsipList'));
}


    public function create()
    {
        return view('admin.arsip_surat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'nullable|string|max:255',
            'pengirim_penerima' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'jenis' => 'nullable|in:masuk,keluar',
        'file_surat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string',
        ], [
            'file_surat.max' => 'Ukuran file maksimal 2MB',
            'file_surat.mimes' => 'Format file harus PDF, JPG, atau PNG',
            'jenis.in' => 'Jenis surat harus "masuk" atau "keluar"',
        ]);

        // Format tanggal (jika ada)
        if ($validated['tanggal']) {
            $validated['tanggal'] = Carbon::parse($validated['tanggal'])->format('Y-m-d');
        }

        // Tangani file terenkripsi (jika ada)
        if ($request->hasFile('file_surat')) {
            $validated['file_surat'] = $request->file('file_surat');
        }

        // Simpan ke database
        ArsipSurat::create($validated);

      return redirect()->route('arsip-surat.index')->with('success', 'Arsip surat berhasil disimpan.');

    }


public function update(Request $request, $id)
{
    $arsip = ArsipSurat::findOrFail($id);

    $validated = $request->validate([
        'nomor_surat' => 'nullable|string|max:255',
        'pengirim_penerima' => 'nullable|string|max:255',
        'tanggal' => 'nullable|date',
        'jenis' => 'nullable|in:masuk,keluar',
        'file_surat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'deskripsi' => 'nullable|string',
    ], [
        'file_surat.max' => 'Ukuran file maksimal 2MB',
        'file_surat.mimes' => 'Format file harus PDF, JPG, atau PNG',
        'jenis.in' => 'Jenis surat harus "masuk" atau "keluar"',
    ]);

    // Format tanggal jika ada
    if ($validated['tanggal']) {
        $validated['tanggal'] = Carbon::parse($validated['tanggal'])->format('Y-m-d');
    }

    // Tangani file baru (jika diupload)
    if ($request->hasFile('file_surat')) {
        $validated['file_surat'] = $request->file('file_surat');
    }

    // Update arsip
    $arsip->update($validated);

    return redirect()->route('arsip-surat.index')->with('success', 'Arsip surat berhasil diperbarui.');
}

public function show($id)
{
    $arsip = ArsipSurat::findOrFail($id);
    $path = $arsip->getRawOriginal('file_surat');

    if (!$path || !Storage::disk('public')->exists($path)) {
        abort(404, 'File tidak ditemukan.');
    }

    try {
        // Ambil isi terenkripsi dari storage
        $encryptedContent = Storage::disk('public')->get($path);

        // Dekripsi konten binary
        $decrypted = Crypt::decrypt($encryptedContent);

        // Ekstrak nama file untuk ambil ekstensi asli (misal: .pdf.enc -> pdf)
        $filename = basename($path);
        preg_match('/\.([a-zA-Z0-9]+)\.enc$/', $filename, $matches);
        $extension = strtolower($matches[1] ?? 'pdf'); // default ke PDF jika gagal

        // Tentukan MIME type
        $mimeType = match ($extension) {
            'pdf' => 'application/pdf',
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            default => 'application/octet-stream',
        };

        return response($decrypted)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline; filename="preview.'.$extension.'"');
    } catch (\Exception $e) {
        return abort(500, 'Gagal membuka file: ' . $e->getMessage());
    }
}




//destroy
public function destroy($id)
{
    $arsip = ArsipSurat::findOrFail($id);

    // Hapus file dari storage
    if ($arsip->file_surat && Storage::disk('public')->exists($arsip->file_surat)) {
        Storage::disk('public')->delete($arsip->file_surat);
    }

    // Hapus arsip dari database
    $arsip->delete();

    return redirect()->route('arsip-surat.index')->with('success', 'Arsip surat berhasil dihapus.');
}



}
