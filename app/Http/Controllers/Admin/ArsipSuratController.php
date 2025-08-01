<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\ArsipSurat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ArsipSuratController extends Controller
{
    public function index(Request $request)
    {
        $query = ArsipSurat::query();

        // Filter keyword pencarian
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($qBuilder) use ($q) {
                $qBuilder->where('nomor_surat', 'like', "%$q%")
                    ->orWhere('pengirim_penerima', 'like', "%$q%")
                    ->orWhere('deskripsi', 'like', "%$q%");
            });
        }

        // Filter jenis surat
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal', [$request->tanggal_mulai, $request->tanggal_selesai]);
        } elseif ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_mulai);
        } elseif ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_selesai);
        }


        $arsipList = $query->latest()->paginate(10)->appends($request->all());

        // Statistik
        $totalSurat = ArsipSurat::count();
        $suratMasuk = ArsipSurat::where('jenis', 'masuk')->count();
        $suratKeluar = ArsipSurat::where('jenis', 'keluar')->count();
        $suratBulanIni = ArsipSurat::whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->count();

        return view('admin.arsip_surat.index', compact(
            'arsipList',
            'totalSurat',
            'suratMasuk',
            'suratKeluar',
            'suratBulanIni'
        ));
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
            'file_surat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'deskripsi' => 'nullable|string',
        ], [
            'file_surat.max' => 'Ukuran file maksimal 5MB',
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

    /**
     * Update an existing ArsipSurat
     */
    public function edit($id)
    {
        $arsip = ArsipSurat::findOrFail($id);
        return view('admin.arsip_surat.edit', compact('arsip'));
    }


    public function update(Request $request, $id)
    {
        $arsip = ArsipSurat::findOrFail($id);

        $validated = $request->validate([
            'nomor_surat' => 'nullable|string|max:255',
            'pengirim_penerima' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'jenis' => 'nullable|in:masuk,keluar',
            'file_surat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'deskripsi' => 'nullable|string',
        ], [
            'file_surat.max' => 'Ukuran file maksimal 5MB',
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
                ->header('Content-Disposition', 'inline; filename="preview.' . $extension . '"');
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
