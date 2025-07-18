<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        // Ambil nilai dengan decrypt otomatis
        $settings = [
            'admin_whatsapp_number' => Setting::getValue('admin_whatsapp_number', '6285850512135'),
            'fonnte_api_token' => Setting::getValue('fonnte_api_token', env('FONNTE_API_TOKEN', ''))
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'admin_whatsapp_number' => 'required|string|max:20',
            'fonnte_api_token' => 'required|string'
        ]);

        // Simpan dengan enkripsi otomatis
        Setting::updateOrCreateEncrypted(
            'admin_whatsapp_number',
            $validated['admin_whatsapp_number']
        );

        Setting::updateOrCreateEncrypted(
            'fonnte_api_token',
            $validated['fonnte_api_token']
        );

        return back()->with('success', 'Pengaturan berhasil diperbarui');
    }
}
