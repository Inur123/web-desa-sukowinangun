<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SktmController extends Controller
{
    public function index()
    {
        return view('admin.layanan.sktm.index');
    }

    public function store(Request $request)
    {
        // Cegah admin login mengisi form
        if (Auth::check() && Auth::user()->role === 'admin') {
            abort(403, 'Admin tidak boleh mengajukan SKTM.');
        }

        // Validasi data dari publik
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|digits:16',
            'alamat' => 'required|string',
            // tambahkan sesuai kebutuhan
        ]);

        // Simpan ke database
        // Sktm::create($validated); // (kalau kamu sudah punya model SKTM)

        return redirect()->back()->with('success', 'Pengajuan SKTM berhasil dikirim.');
    }
}
