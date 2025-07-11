<?php

namespace App\Http\Controllers\Layanan;

use App\Models\Sku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SkuController extends Controller
{
    public function create()
    {
        return view('user.layanan.sku.create');
    }

    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'ttl' => 'required|date',
            'nik' => 'required|digits:16',
            'alamat' => 'required|string',
            'status_perkawinan' => 'required|string|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'nama_usaha' => 'required|string|max:255',
            'alamat_usaha' => 'required|string',
            'keperluan' => 'required|string|max:255',
            'pengantar_rt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'no_hp' => 'required|string|max:25',
        ], [
            'nik.digits' => 'NIK harus terdiri dari 16 digit angka',
            'pengantar_rt.max' => 'File Surat Pengantar RT tidak boleh lebih dari 2MB',
            'ktp.max' => 'File KTP tidak boleh lebih dari 2MB',
            'required' => 'Field :attribute wajib diisi',
            'mimes' => 'File harus berupa PDF, JPG, atau PNG'
        ]);

        // Format tanggal
        $validated['ttl'] = Carbon::parse($validated['ttl'])->format('Y-m-d');

        // Handle file uploads
        if ($request->hasFile('pengantar_rt')) {
            $validated['pengantar_rt'] = $request->file('pengantar_rt');
        }

        if ($request->hasFile('ktp')) {
            $validated['ktp'] = $request->file('ktp');
        }
        if (isset($validated['no_hp']) && preg_match('/^0\d+$/', $validated['no_hp'])) {
    $validated['no_hp'] = '62' . substr($validated['no_hp'], 1);
}

        // Tambahkan status default 'baru'
        $validated['status'] = 'baru';

        // Simpan ke database
        Sku::create($validated);

        return redirect()->back()
            ->with('success', 'Pengajuan Surat Keterangan Usaha berhasil dikirim.');
    } catch (\Exception $e) {
        // Hapus file jika gagal
        if (isset($validated['pengantar_rt']) && is_string($validated['pengantar_rt'])) {
            Storage::disk('public')->delete($validated['pengantar_rt']);
        }
        if (isset($validated['ktp']) && is_string($validated['ktp'])) {
            Storage::disk('public')->delete($validated['ktp']);
        }

        return redirect()->back()
            ->withInput()
            ->withErrors(['error' => 'Terjadi kesalahan sistem. Silakan coba lagi atau hubungi admin.']);
    }
}

}
