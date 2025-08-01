<?php

namespace App\Http\Controllers\Layanan;

use Carbon\Carbon;
use App\Models\Setting;
use App\Models\HargaTanah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class HargaTanahController extends Controller
{

    public function index()
{
    $hargaTanahs = HargaTanah::latest()->paginate(10);

    $total = HargaTanah::count();
    $disetujui = HargaTanah::where('status', 'diterima')->count();
    $ditolak = HargaTanah::where('status', 'ditolak')->count();
    $baru = HargaTanah::where('status', 'baru')->count();

    return view('admin.layanan.harga-tanah.index', compact('hargaTanahs', 'total', 'disetujui', 'ditolak', 'baru'));
}

    public function create()
    {
        return view('user.layanan.harga-tanah.create');
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
                'alamat_tanah' => 'required|string',
                'harga_per_meter' => 'required|string|max:255',
                'status_perkawinan' => 'required|string|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
                'keperluan' => 'required|string|max:255',
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
            // Format TTL dan No HP
            $validated['ttl'] = Carbon::parse($validated['ttl'])->format('Y-m-d');
            if (preg_match('/^0\d+$/', $validated['no_hp'])) {
                $validated['no_hp'] = '62' . substr($validated['no_hp'], 1);
            }
            $validated['status'] = 'baru';

            // Buat objek baru
            $hargaTanah = new HargaTanah($validated);


           // Atur file/kamera
            $hargaTanah->pengantar_rt = $request->file('pengantar_rt_file') ?? $request->input('pengantar_rt_camera');
            $hargaTanah->ktp = $request->file('ktp_file') ?? $request->input('ktp_camera');
            $hargaTanah->kk = $request->file('kk_file') ?? $request->input('kk_camera');

            // Simpan
            $hargaTanah->save();

            // Kirim notifikasi ke user
            $userMessage = "Halo {$validated['nama']},\n\nTerima kasih telah mengajukan Surat Harga Tanah. Pengajuan Anda telah kami terima dengan detail sebagai berikut:\n\nKeperluan: {$validated['keperluan']}\nAlamat Tanah: {$validated['alamat_tanah']}\nHarga per Meter: {$validated['harga_per_meter']}\n\nKami akan memproses pengajuan Anda segera. Anda akan mendapatkan notifikasi berikutnya ketika status pengajuan berubah.\n\nSalam hormat,\nAdmin";

            $this->sendWhatsAppNotification($validated['no_hp'], $userMessage);

            // Kirim notifikasi ke admin
            $adminNumber = Setting::getValue('admin_whatsapp_number', '6285850512135');
            $adminMessage = "Ada pengajuan Surat Harga Tanah baru dari:\n\nNama: {$validated['nama']}\nNIK: {$validated['nik']}\nNo. HP: {$validated['no_hp']}\nAlamat Tanah: {$validated['alamat_tanah']}\nHarga per Meter: {$validated['harga_per_meter']}\n\nSilakan periksa sistem untuk detail lebih lanjut.";

            $this->sendWhatsAppNotification($adminNumber, $adminMessage);

            return redirect()->back()
                ->with('success', 'Pengajuan Surat Harga Tanah berhasil dikirim.');
      }  catch (\Exception $e) {
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
        $hargaTanah = HargaTanah::findOrFail($id);
        return view('admin.layanan.harga-tanah.show', compact('hargaTanah'));
    }

  public function showFile($id, $type)
{
    $hargaTanah = HargaTanah::findOrFail($id);

    // Validate file type
    if (!in_array($type, ['ktp', 'pengantar', 'kk'])) {
        abort(404);
    }

    // Get file path from the correct attribute
    $path = $hargaTanah->getRawOriginal($type === 'ktp' ? 'ktp' : ($type === 'pengantar' ? 'pengantar_rt' : 'kk'));

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
                      . $hargaTanah->nama . '.' . $extension;

        return response($decrypted)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline; filename="' . $displayName . '"');
    } catch (\Exception $e) {
        return abort(500, 'Gagal membuka file: ' . $e->getMessage());
    }
}

    public function approve($id)
    {
        $hargaTanah = HargaTanah::findOrFail($id);
        $hargaTanah->status = 'diterima';
        $hargaTanah->save();

        $userMessage = "Halo {$hargaTanah->nama},\n\nPengajuan Surat Harga Tanah Anda *TELAH DISETUJUI*.\n\nKelengkapan administrasi sudah sesuai dan surat dapat diambil di:\n\nKantor Kelurahan Sukowinangun\nJl. Kunti No. 3\nJam kerja: Senin-Jumat 07.30-15.30\n\nHarap membawa bukti identitas saat pengambilan.\n\nTerima kasih.";

        $this->sendWhatsAppNotification($hargaTanah->no_hp, $userMessage);

        return redirect()->back()->with('success', 'Pengajuan telah disetujui dan notifikasi terkirim ke pemohon.');
    }

    public function reject($id)
    {
        $hargaTanah = HargaTanah::findOrFail($id);
        $hargaTanah->status = 'ditolak';
        $hargaTanah->save();

        $userMessage = "Halo {$hargaTanah->nama},\n\nMaaf pengajuan Surat Harga Tanah Anda *DITOLAK* karena:\n\n- Kelengkapan dokumen tidak sesuai\n- Data tidak valid\n\nSilakan perbaiki pengajuan dan ajukan kembali.\n\nUntuk informasi lebih lanjut, hubungi:\n\nKantor Kelurahan Sukowinangun\nJl. Kunti No. 3\nTelp: 021-1234567";

        $this->sendWhatsAppNotification($hargaTanah->no_hp, $userMessage);

        return redirect()->back()->with('success', 'Pengajuan telah ditolak dan notifikasi terkirim ke pemohon.');
    }

    public function destroy($id)
    {
        try {
            $hargaTanah = HargaTanah::findOrFail($id);

            $ktpPath = $hargaTanah->getRawOriginal('ktp');
            $pengantarPath = $hargaTanah->getRawOriginal('pengantar_rt');
            $kkPath = $hargaTanah->getRawOriginal('kk');

            if ($ktpPath && Storage::disk('public')->exists($ktpPath)) {
                Storage::disk('public')->delete($ktpPath);
            }
            if ($pengantarPath && Storage::disk('public')->exists($pengantarPath)) {
                Storage::disk('public')->delete($pengantarPath);
            }
            if ($kkPath && Storage::disk('public')->exists($kkPath)) {
                Storage::disk('public')->delete($kkPath);
            }

            $hargaTanah->delete();

            return redirect()->back()->with('success', 'Data pengajuan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }
}
