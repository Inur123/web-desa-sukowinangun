<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BroadcastWaController extends Controller
{
     public function index()
    {
        try {
            $settings = [
                'admin_whatsapp_number' => Setting::getValue('admin_whatsapp_number', '6285850512135'),
                'fonnte_api_token' => Setting::getValue('fonnte_api_token', env('FONNTE_API_TOKEN', ''))
            ];

            return view('admin.setting.BroadcastWa', compact('settings'));
        } catch (\Exception $e) {
            Log::error('Error in BroadcastWaController@index: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat pengaturan');
        }
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'admin_whatsapp_number' => 'required|string|max:20',
            'fonnte_api_token' => 'required|string'
        ]);

        try {
            Setting::updateOrCreateEncrypted('admin_whatsapp_number', $validated['admin_whatsapp_number']);
            Setting::updateOrCreateEncrypted('fonnte_api_token', $validated['fonnte_api_token']);

            return back()->with('success', 'Pengaturan berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Error in BroadcastWaController@update: ' . $e->getMessage());
            return back()->with('error', 'Gagal memperbarui pengaturan');
        }
    }
}
