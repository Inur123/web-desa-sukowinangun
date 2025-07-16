<?php

namespace App\Http\Controllers\Layanan;

use App\Models\Kelahiran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class KelahiranController extends Controller
{
    public function index()
    {
        $kelahirans = Kelahiran::latest()->paginate(10);
        $total = Kelahiran::count();
        $disetujui = Kelahiran::where('status', 'diterima')->count();
        $ditolak = Kelahiran::where('status', 'ditolak')->count();
        $baru = Kelahiran::where('status', 'baru')->count();

        return view('admin.layanan.kelahiran.index', compact('kelahirans', 'total', 'disetujui', 'ditolak', 'baru'));
    }

    public function create()
    {
        return view('user.layanan.kelahiran.create');
    }

    public function store(Request $request)
    {
        try {
            // Validasi semua input termasuk alternatif file/kamera
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'ttl' => 'required|date',
                'nik' => 'required|digits:16',
                'alamat' => 'required|string',
                'status_perkawinan' => 'required|string|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
                'pengantar_rt_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'pengantar_rt_camera' => 'nullable|string',
                'ktp_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'ktp_camera' => 'nullable|string',
                'kk_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'kk_camera' => 'nullable|string',
                'surat_keterangan_bidan_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'surat_keterangan_bidan_camera' => 'nullable|string',
                'no_hp' => 'required|string|max:25',
            ], [
                'nik.digits' => 'NIK harus terdiri dari 16 digit angka',
                'required' => 'Field :attribute wajib diisi',
                'mimes' => 'File harus berupa PDF, JPG, atau PNG',
                'pengantar_rt_file.max' => 'File Surat Pengantar RT tidak boleh lebih dari 2MB',
                'ktp_file.max' => 'File KTP tidak boleh lebih dari 2MB',
                'kk_file.max' => 'File KK tidak boleh lebih dari 2MB',
                'surat_keterangan_bidan_file.max' => 'File Surat Keterangan Bidan tidak boleh lebih dari 2MB',
            ]);

            // Validasi minimal salah satu file/kamera harus ada
            if (!$request->hasFile('pengantar_rt_file') && !$request->filled('pengantar_rt_camera')) {
                return redirect()->back()->withInput()->withErrors(['pengantar_rt_file' => 'Harap unggah file atau ambil foto Surat Pengantar RT.']);
            }
            if (!$request->hasFile('ktp_file') && !$request->filled('ktp_camera')) {
                return redirect()->back()->withInput()->withErrors(['ktp_file' => 'Harap unggah file atau ambil foto KTP.']);
            }
            if (!$request->hasFile('kk_file') && !$request->filled('kk_camera')) {
                return redirect()->back()->withInput()->withErrors(['kk_file' => 'Harap unggah file atau ambil foto KK.']);
            }
            if (!$request->hasFile('surat_keterangan_bidan_file') && !$request->filled('surat_keterangan_bidan_camera')) {
                return redirect()->back()->withInput()->withErrors(['surat_keterangan_bidan_file' => 'Harap unggah file atau ambil foto Surat Keterangan Bidan/Dokter.']);
            }

            // Format TTL dan No HP
            $validated['ttl'] = Carbon::parse($validated['ttl'])->format('Y-m-d');
            if (preg_match('/^0\d+$/', $validated['no_hp'])) {
                $validated['no_hp'] = '62' . substr($validated['no_hp'], 1);
            }
            $validated['status'] = 'baru';

            // Buat objek baru
            $kelahiran = new Kelahiran($validated);

            // Atur file/kamera
            $kelahiran->pengantar_rt = $request->file('pengantar_rt_file') ?? $request->input('pengantar_rt_camera');
            $kelahiran->ktp = $request->file('ktp_file') ?? $request->input('ktp_camera');
            $kelahiran->kk = $request->file('kk_file') ?? $request->input('kk_camera');
            $kelahiran->surat_keterangan_bidan = $request->file('surat_keterangan_bidan_file') ?? $request->input('surat_keterangan_bidan_camera');

            // Simpan
            $kelahiran->save();

            // Kirim notifikasi ke user
            $userMessage = "Halo {$validated['nama']},\n\nTerima kasih telah mengajukan Surat Keterangan Kelahiran. Pengajuan Anda telah kami terima dengan detail sebagai berikut:\n\nNama: {$validated['nama']}\nTanggal Lahir: {$validated['ttl']}\n\nKami akan memproses pengajuan Anda segera. Anda akan mendapatkan notifikasi berikutnya ketika status pengajuan berubah.\n\nSalam hormat,\nAdmin";

            $this->sendWhatsAppNotification($validated['no_hp'], $userMessage);

            // Kirim notifikasi ke admin
            $adminNumber = '6285850512135';
            $adminMessage = "Ada pengajuan Surat Keterangan Kelahiran baru dari:\n\nNama: {$validated['nama']}\nNIK: {$validated['nik']}\nNo. HP: {$validated['no_hp']}\nTanggal Lahir: {$validated['ttl']}\n\nSilakan periksa sistem untuk detail lebih lanjut.";

            $this->sendWhatsAppNotification($adminNumber, $adminMessage);

            return redirect()->back()
                ->with('success', 'Pengajuan Surat Keterangan Kelahiran berhasil dikirim.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan sistem. Silakan coba lagi atau hubungi admin.']);
        }
    }

    private function sendWhatsAppNotification($phoneNumber, $message)
    {
        $apiToken = env('FONNTE_API_TOKEN');
        $url = 'https://api.fonnte.com/send';

        $data = [
            'target' => $phoneNumber,
            'message' => $message,
            'delay' => '5-10',
        ];

        $headers = [
            'Authorization: ' . $apiToken,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);
    }

    public function show($id)
    {
        $kelahiran = Kelahiran::findOrFail($id);
        return view('admin.layanan.kelahiran.show', compact('kelahiran'));
    }

    public function showFile($id, $type)
    {
        $kelahiran = Kelahiran::findOrFail($id);

        // Validate file type
        if (!in_array($type, ['ktp', 'pengantar', 'kk', 'bidan'])) {
            abort(404);
        }

        // Get file path
        $path = $kelahiran->getRawOriginal(
            $type === 'ktp' ? 'ktp' :
            ($type === 'pengantar' ? 'pengantar_rt' :
            ($type === 'kk' ? 'kk' : 'surat_keterangan_bidan'))
        );

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
            $displayName = ($type === 'ktp' ? 'KTP_' :
                          ($type === 'pengantar' ? 'Pengantar_RT_' :
                          ($type === 'kk' ? 'KK_' : 'Surat_Bidan_'))) . $kelahiran->nama . '.' . $extension;

            return response($decrypted)
                ->header('Content-Type', $mimeType)
                ->header('Content-Disposition', 'inline; filename="' . $displayName . '"');
        } catch (\Exception $e) {
            return abort(500, 'Gagal membuka file: ' . $e->getMessage());
        }
    }

    public function approve($id)
    {
        $kelahiran = Kelahiran::findOrFail($id);
        $kelahiran->status = 'diterima';
        $kelahiran->save();

        // Kirim notifikasi hanya ke pengguna
        $userMessage = "Halo {$kelahiran->nama},\n\nPengajuan Surat Keterangan Kelahiran Anda *TELAH DISETUJUI*.\n\nKelengkapan administrasi sudah sesuai dan surat dapat diambil di:\n\nKantor Kelurahan Sukowinangun\nJl. Kunti No. 3\nJam kerja: Senin-Jumat 07.30-15.30\n\nHarap membawa bukti identitas saat pengambilan.\n\nTerima kasih.";

        $this->sendWhatsAppNotification($kelahiran->no_hp, $userMessage);

        return redirect()->back()->with('success', 'Pengajuan telah disetujui dan notifikasi terkirim ke pemohon.');
    }

    public function reject($id)
    {
        $kelahiran = Kelahiran::findOrFail($id);
        $kelahiran->status = 'ditolak';
        $kelahiran->save();

        // Kirim notifikasi hanya ke pengguna
        $userMessage = "Halo {$kelahiran->nama},\n\nMaaf pengajuan Surat Keterangan Kelahiran Anda *DITOLAK* karena:\n\n- Kelengkapan dokumen tidak sesuai\n- Data tidak valid\n\nSilakan perbaiki pengajuan dan ajukan kembali.\n\nUntuk informasi lebih lanjut, hubungi:\n\nKantor Kelurahan Sukowinangun\nJl. Kunti No. 3\nTelp: 021-1234567";

        $this->sendWhatsAppNotification($kelahiran->no_hp, $userMessage);

        return redirect()->back()->with('success', 'Pengajuan telah ditolak dan notifikasi terkirim ke pemohon.');
    }

    public function destroy($id)
    {
        try {
            $kelahiran = Kelahiran::findOrFail($id);

            // Hapus file jika ada
            $ktpPath = $kelahiran->getRawOriginal('ktp');
            $pengantarPath = $kelahiran->getRawOriginal('pengantar_rt');
            $kkPath = $kelahiran->getRawOriginal('kk');
            $bidanPath = $kelahiran->getRawOriginal('surat_keterangan_bidan');

            if ($ktpPath && Storage::disk('public')->exists($ktpPath)) {
                Storage::disk('public')->delete($ktpPath);
            }

            if ($pengantarPath && Storage::disk('public')->exists($pengantarPath)) {
                Storage::disk('public')->delete($pengantarPath);
            }

            if ($kkPath && Storage::disk('public')->exists($kkPath)) {
                Storage::disk('public')->delete($kkPath);
            }

            if ($bidanPath && Storage::disk('public')->exists($bidanPath)) {
                Storage::disk('public')->delete($bidanPath);
            }

            // Hapus data dari database
            $kelahiran->delete();

            return redirect()->back()->with('success', 'Data pengajuan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }
}
