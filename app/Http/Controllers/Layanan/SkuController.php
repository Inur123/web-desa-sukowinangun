<?php

namespace App\Http\Controllers\Layanan;

use App\Models\Sku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

class SkuController extends Controller
{
   public function index()
{
    $skus = Sku::latest()->paginate(10);

    $total = Sku::count();
    $disetujui = Sku::where('status', 'diterima')->count();
    $ditolak = Sku::where('status', 'ditolak')->count();
    $baru = Sku::where('status', 'baru')->count();

    return view('admin.layanan.sku.index', compact('skus', 'total', 'disetujui', 'ditolak', 'baru'));
}



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

            $validated['ttl'] = Carbon::parse($validated['ttl'])->format('Y-m-d');

            if (isset($validated['no_hp']) && preg_match('/^0\d+$/', $validated['no_hp'])) {
                $validated['no_hp'] = '62' . substr($validated['no_hp'], 1);
            }

            $validated['status'] = 'baru';

            Sku::create($validated);

            return redirect()->back()
                ->with('success', 'Pengajuan Surat Keterangan Usaha berhasil dikirim.');
        } catch (\Exception $e) {
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

    public function show($id)
    {
        $sku = Sku::findOrFail($id);
        return view('admin.layanan.sku.show', compact('sku'));
    }

    public function showFile($id, $type)
    {
        $sku = Sku::findOrFail($id);

        // Validate file type
        if (!in_array($type, ['ktp', 'pengantar'])) {
            abort(404);
        }

        // Get file path
        $path = $sku->getRawOriginal($type === 'ktp' ? 'ktp' : 'pengantar_rt');

        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        try {
            // Get encrypted content from storage
            $encryptedContent = Storage::disk('public')->get($path);

            // Decrypt binary content
            $decrypted = Crypt::decrypt($encryptedContent);

            // Extract filename to get original extension
            $filename = basename($path);
            preg_match('/\.([a-zA-Z0-9]+)\.enc$/', $filename, $matches);
            $extension = strtolower($matches[1] ?? 'pdf'); // default to PDF if extraction fails

            // Determine MIME type
            $mimeType = match ($extension) {
                'pdf' => 'application/pdf',
                'jpg', 'jpeg' => 'image/jpeg',
                'png' => 'image/png',
                default => 'application/octet-stream',
            };

            // Generate filename for display
            $displayName = ($type === 'ktp' ? 'KTP_' : 'Pengantar_RT_') . $sku->nama . '.' . $extension;

            return response($decrypted)
                ->header('Content-Type', $mimeType)
                ->header('Content-Disposition', 'inline; filename="' . $displayName . '"');

        } catch (\Exception $e) {
            return abort(500, 'Gagal membuka file: ' . $e->getMessage());
        }
    }

    public function approve($id)
    {
        $sku = Sku::findOrFail($id);
        $sku->status = 'diterima';
        $sku->save();

        return redirect()->back()->with('success', 'Pengajuan telah disetujui.');
    }

    public function reject($id)
    {
        $sku = Sku::findOrFail($id);
        $sku->status = 'ditolak';
        $sku->save();

        return redirect()->back()->with('success', 'Pengajuan telah ditolak.');
    }

public function destroy($id)
{
    try {
        $sku = Sku::findOrFail($id);

        // Hapus file jika ada
        $ktpPath = $sku->getRawOriginal('ktp');
        $pengantarPath = $sku->getRawOriginal('pengantar_rt');

        if ($ktpPath && Storage::disk('public')->exists($ktpPath)) {
            Storage::disk('public')->delete($ktpPath);
        }

        if ($pengantarPath && Storage::disk('public')->exists($pengantarPath)) {
            Storage::disk('public')->delete($pengantarPath);
        }

        // Hapus data dari database
        $sku->delete();

        return redirect()->back()->with('success', 'Data pengajuan berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal menghapus data. Silakan coba lagi.');
    }
}

}
