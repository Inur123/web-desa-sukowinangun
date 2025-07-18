<?php

namespace App\Http\Controllers\Layanan;

use Carbon\Carbon;
use App\Models\Setting;
use App\Models\Kematian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class KematianController extends Controller
{
    public function index()
    {
        $kematians = Kematian::latest()->paginate(10);

        $total = Kematian::count();
        $disetujui = Kematian::where('status', 'diterima')->count();
        $ditolak = Kematian::where('status', 'ditolak')->count();
        $baru = Kematian::where('status', 'baru')->count();

        return view('admin.layanan.kematian.index', compact('kematians', 'total', 'disetujui', 'ditolak', 'baru'));
    }

    public function create()
    {
        return view('user.layanan.kematian.create');
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
                'tanggal_meninggal' => 'required|date',
                'status_perkawinan' => 'required|string|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
                'pengantar_rt_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'pengantar_rt_camera' => 'nullable|string',
                'ktp_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'ktp_camera' => 'nullable|string',
                'kk_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'kk_camera' => 'nullable|string',
                'no_hp' => 'required|string|max:25',
            ], [
                'nik.digits' => 'NIK harus terdiri dari 16 digit angka',
                'required' => 'Field :attribute wajib diisi',
                'mimes' => 'File harus berupa PDF, JPG, atau PNG',
                'pengantar_rt_file.max' => 'File Surat Pengantar RT tidak boleh lebih dari 5MB',
                'ktp_file.max' => 'File KTP tidak boleh lebih dari 5MB',
                'kk_file.max' => 'File KK tidak boleh lebih dari 5MB',
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

            // Format TTL, tanggal meninggal, dan No HP
            $validated['ttl'] = Carbon::parse($validated['ttl'])->format('Y-m-d');
            $validated['tanggal_meninggal'] = Carbon::parse($validated['tanggal_meninggal'])->format('Y-m-d');
            if (preg_match('/^0\d+$/', $validated['no_hp'])) {
                $validated['no_hp'] = '62' . substr($validated['no_hp'], 1);
            }
            $validated['status'] = 'baru';

            // Buat objek baru
            $kematian = new Kematian($validated);

            // Atur file/kamera
            $kematian->pengantar_rt = $request->file('pengantar_rt_file') ?? $request->input('pengantar_rt_camera');
            $kematian->ktp = $request->file('ktp_file') ?? $request->input('ktp_camera');
            $kematian->kk = $request->file('kk_file') ?? $request->input('kk_camera');

            // Simpan
            $kematian->save();

            // Kirim notifikasi ke user
            $userMessage = "Halo {$validated['nama']},\n\nTerima kasih telah mengajukan Surat Kematian. Pengajuan Anda telah kami terima dengan detail sebagai berikut:\n\nNama: {$validated['nama']}\nTanggal Meninggal: {$validated['tanggal_meninggal']}\n\nKami akan memproses pengajuan Anda segera. Anda akan mendapatkan notifikasi berikutnya ketika status pengajuan berubah.\n\nSalam hormat,\nAdmin";

            $this->sendWhatsAppNotification($validated['no_hp'], $userMessage);

            // Kirim notifikasi ke admin
            $adminNumber = Setting::getValue('admin_whatsapp_number', '6285850512135');
            $adminMessage = "Ada pengajuan Surat Kematian baru dari:\n\nNama: {$validated['nama']}\nNIK: {$validated['nik']}\nNo. HP: {$validated['no_hp']}\nTanggal Meninggal: {$validated['tanggal_meninggal']}\n\nSilakan periksa sistem untuk detail lebih lanjut.";

            $this->sendWhatsAppNotification($adminNumber, $adminMessage);

            return redirect()->back()
                ->with('success', 'Pengajuan Surat Kematian berhasil dikirim.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan sistem. Silakan coba lagi atau hubungi admin.']);
        }
    }

    private function sendWhatsAppNotification($phoneNumber, $message)
    {
        $apiToken = Setting::getValue('fonnte_api_token', env('FONNTE_API_TOKEN'));
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
        $kematian = Kematian::findOrFail($id);
        return view('admin.layanan.kematian.show', compact('kematian'));
    }

    public function showFile($id, $type)
    {
        $kematian = Kematian::findOrFail($id);

        // Validate file type
        if (!in_array($type, ['ktp', 'pengantar', 'kk'])) {
            abort(404);
        }

        // Get file path from the correct attribute
        $path = $kematian->getRawOriginal($type === 'ktp' ? 'ktp' : ($type === 'pengantar' ? 'pengantar_rt' : 'kk'));

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
            preg_match('/\.([a-zA-Z0-9]+)(\.enc)?$/', $filename, $matches);
            $extension = strtolower($matches[1] ?? 'pdf'); // default to PDF if extraction fails

            // Determine MIME type
            $mimeType = match ($extension) {
                'pdf' => 'application/pdf',
                'jpg', 'jpeg' => 'image/jpeg',
                'png' => 'image/png',
                default => 'application/octet-stream',
            };

            // Generate filename for display
            $displayName = ($type === 'ktp' ? 'KTP_' : ($type === 'pengantar' ? 'Pengantar_RT_' : 'KK_'))
                        . $kematian->nama . '.' . $extension;

            return response($decrypted)
                ->header('Content-Type', $mimeType)
                ->header('Content-Disposition', 'inline; filename="' . $displayName . '"');
        } catch (\Exception $e) {
            return abort(500, 'Gagal membuka file: ' . $e->getMessage());
        }
    }

    public function approve($id)
    {
        $kematian = Kematian::findOrFail($id);
        $kematian->status = 'diterima';
        $kematian->save();

        $userMessage = "Halo {$kematian->nama},\n\nPengajuan Surat Kematian Anda *TELAH DISETUJUI*.\n\nKelengkapan administrasi sudah sesuai dan surat dapat diambil di:\n\nKantor Kelurahan Sukowinangun\nJl. Kunti No. 3\nJam kerja: Senin-Jumat 07.30-15.30\n\nHarap membawa bukti identitas saat pengambilan.\n\nTerima kasih.";

        $this->sendWhatsAppNotification($kematian->no_hp, $userMessage);

        return redirect()->back()->with('success', 'Pengajuan telah disetujui dan notifikasi terkirim ke pemohon.');
    }

    public function reject($id)
    {
        $kematian = Kematian::findOrFail($id);
        $kematian->status = 'ditolak';
        $kematian->save();

        $userMessage = "Halo {$kematian->nama},\n\nMaaf pengajuan Surat Kematian Anda *DITOLAK* karena:\n\n- Kelengkapan dokumen tidak sesuai\n- Data tidak valid\n\nSilakan perbaiki pengajuan dan ajukan kembali.\n\nUntuk informasi lebih lanjut, hubungi:\n\nKantor Kelurahan Sukowinangun\nJl. Kunti No. 3\nTelp: 021-1234567";

        $this->sendWhatsAppNotification($kematian->no_hp, $userMessage);

        return redirect()->back()->with('success', 'Pengajuan telah ditolak dan notifikasi terkirim ke pemohon.');
    }

    public function destroy($id)
    {
        try {
            $kematian = Kematian::findOrFail($id);

            $ktpPath = $kematian->getRawOriginal('ktp');
            $pengantarPath = $kematian->getRawOriginal('pengantar_rt');
            $kkPath = $kematian->getRawOriginal('kk');

            if ($ktpPath && Storage::disk('public')->exists($ktpPath)) {
                Storage::disk('public')->delete($ktpPath);
            }
            if ($pengantarPath && Storage::disk('public')->exists($pengantarPath)) {
                Storage::disk('public')->delete($pengantarPath);
            }
            if ($kkPath && Storage::disk('public')->exists($kkPath)) {
                Storage::disk('public')->delete($kkPath);
            }

            $kematian->delete();

            return redirect()->back()->with('success', 'Data pengajuan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }
}
