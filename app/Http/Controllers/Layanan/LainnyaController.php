<?php

namespace App\Http\Controllers\Layanan;

use App\Models\Lainnya;
use App\Models\LainnyaFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class LainnyaController extends Controller
{
    public function index()
    {
        $lainnya = Lainnya::with('files')->latest()->paginate(10);
        $total = Lainnya::count();
        $disetujui = Lainnya::where('status', 'diterima')->count();
        $ditolak = Lainnya::where('status', 'ditolak')->count();
        $baru = Lainnya::where('status', 'baru')->count();

        return view('admin.layanan.lainnya.index', compact('lainnya', 'total', 'disetujui', 'ditolak', 'baru'));
    }

    public function create()
    {
        return view('user.layanan.lainnya.create');
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
                'keperluan' => 'required|string|max:255',
                'no_hp' => 'required|string|max:25',
                'file_names' => 'required|array|min:1',
                'file_names.*' => 'required|string|max:255',
            ], [
                'nik.digits' => 'NIK harus terdiri dari 16 digit angka',
                'required' => 'Field :attribute wajib diisi',
                'file_names.required' => 'Minimal harus ada 1 file yang diupload',
                'file_names.*.required' => 'Nama file tidak boleh kosong',
            ]);

            $fileCount = 0;
            $fileData = [];

            foreach ($request->input('file_names', []) as $index => $fileName) {
                $hasFile = $request->hasFile("files.{$index}");
                $hasCamera = !empty($request->input("camera_data.{$index}"));

                if ($hasFile) {
                    $file = $request->file("files.{$index}");

                    $request->validate([
                        "files.{$index}" => 'file|mimes:jpg,jpeg,png,pdf|max:2048'
                    ], [
                        "files.{$index}.mimes" => "File {$fileName} harus berupa PDF, JPG, atau PNG",
                        "files.{$index}.max" => "File {$fileName} tidak boleh lebih dari 2MB",
                    ]);

                    $fileData[] = [
                        'name' => $fileName,
                        'file' => $file,
                        'type' => 'upload'
                    ];
                    $fileCount++;

                } elseif ($hasCamera) {
                    $cameraData = $request->input("camera_data.{$index}");

                    $fileData[] = [
                        'name' => $fileName,
                        'file' => $cameraData,
                        'type' => 'camera'
                    ];
                    $fileCount++;
                }
            }

            if ($fileCount === 0) {
                return redirect()->back()->withInput()->withErrors(['files' => 'Minimal harus ada 1 file yang diupload.']);
            }

            $validated['ttl'] = Carbon::parse($validated['ttl'])->format('Y-m-d');
            if (preg_match('/^0\d+$/', $validated['no_hp'])) {
                $validated['no_hp'] = '62' . substr($validated['no_hp'], 1);
            }
            $validated['status'] = 'baru';

            DB::beginTransaction();

            $lainnya = Lainnya::create($validated);

            foreach ($fileData as $data) {
                $lainnyaFile = new LainnyaFile([
                    'lainnya_id' => $lainnya->id,
                    'nama' => $data['name'],
                    'file' => $data['file']
                ]);
                $lainnyaFile->save();
            }

            DB::commit();

            try {
                $userMessage = "Halo {$validated['nama']},\n\nTerima kasih telah mengajukan layanan lainnya. Pengajuan Anda telah kami terima dengan detail sebagai berikut:\n\nKeperluan: {$validated['keperluan']}\nJumlah File: {$fileCount}\n\nKami akan memproses pengajuan Anda segera. Anda akan mendapatkan notifikasi berikutnya ketika status pengajuan berubah.\n\nSalam hormat,\nAdmin";
                $this->sendWhatsAppNotification($validated['no_hp'], $userMessage);
            } catch (\Exception $notifError) {}

            try {
                $adminNumber = '6285850512135';
                $adminMessage = "Ada pengajuan layanan lainnya baru dari:\n\nNama: {$validated['nama']}\nNIK: {$validated['nik']}\nNo. HP: {$validated['no_hp']}\nKeperluan: {$validated['keperluan']}\nJumlah File: {$fileCount}\n\nSilakan periksa sistem untuk detail lebih lanjut.";
                $this->sendWhatsAppNotification($adminNumber, $adminMessage);
            } catch (\Exception $notifError) {}

            return redirect()->back()->with('success', 'Pengajuan layanan berhasil dikirim.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
        }
    }

    private function sendWhatsAppNotification($phoneNumber, $message)
    {
        $apiToken = env('FONNTE_API_TOKEN');
        if (!$apiToken) return;

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

        curl_exec($ch);
        curl_close($ch);
    }

    public function show($id)
    {
        $lainnya = Lainnya::with('files')->findOrFail($id);
        return view('admin.layanan.lainnya.show', compact('lainnya'));
    }

    public function showFile($id, $fileId)
    {
        $lainnyaFile = LainnyaFile::where('lainnya_id', $id)->findOrFail($fileId);

        $path = $lainnyaFile->getRawOriginal('file');

        if (!$path || !Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        try {
            $encryptedContent = Storage::disk('public')->get($path);
            $decrypted = Crypt::decrypt($encryptedContent);

            $filename = basename($path);
            preg_match('/\.([a-zA-Z0-9]+)\.enc$/', $filename, $matches);
            $extension = strtolower($matches[1] ?? 'pdf');

            $mimeType = match ($extension) {
                'pdf' => 'application/pdf',
                'jpg', 'jpeg' => 'image/jpeg',
                'png' => 'image/png',
                default => 'application/octet-stream',
            };

            $displayName = $lainnyaFile->nama . '.' . $extension;

            return response($decrypted)
                ->header('Content-Type', $mimeType)
                ->header('Content-Disposition', 'inline; filename="' . $displayName . '"');

        } catch (\Exception $e) {
            return abort(500, 'Gagal membuka file: ' . $e->getMessage());
        }
    }

    public function approve($id)
    {
        $lainnya = Lainnya::findOrFail($id);
        $lainnya->status = 'diterima';
        $lainnya->save();

        $userMessage = "Halo {$lainnya->nama},\n\nPengajuan layanan Anda *TELAH DISETUJUI*.\n\nKelengkapan administrasi sudah sesuai dan dokumen dapat diambil di:\n\nKantor Kelurahan Sukowinangun\nJl. Kunti No. 3\nJam kerja: Senin-Jumat 07.30-15.30\n\nHarap membawa bukti identitas saat pengambilan.\n\nTerima kasih.";
        $this->sendWhatsAppNotification($lainnya->no_hp, $userMessage);

        return redirect()->back()->with('success', 'Pengajuan telah disetujui dan notifikasi terkirim ke pemohon.');
    }

    public function reject($id)
    {
        $lainnya = Lainnya::findOrFail($id);
        $lainnya->status = 'ditolak';
        $lainnya->save();

        $userMessage = "Halo {$lainnya->nama},\n\nMaaf pengajuan layanan Anda *DITOLAK* karena:\n\n- Kelengkapan dokumen tidak sesuai\n- Data tidak valid\n\nSilakan perbaiki pengajuan dan ajukan kembali.\n\nUntuk informasi lebih lanjut, hubungi:\n\nKantor Kelurahan Sukowinangun\nJl. Kunti No. 3\nTelp: 021-1234567";
        $this->sendWhatsAppNotification($lainnya->no_hp, $userMessage);

        return redirect()->back()->with('success', 'Pengajuan telah ditolak dan notifikasi terkirim ke pemohon.');
    }

    public function destroy($id)
    {
        try {
            $lainnya = Lainnya::with('files')->findOrFail($id);

            DB::beginTransaction();

            foreach ($lainnya->files as $file) {
                $filePath = $file->getRawOriginal('file');
                if ($filePath && Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
                $file->delete();
            }

            $lainnya->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Data pengajuan berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }
}
