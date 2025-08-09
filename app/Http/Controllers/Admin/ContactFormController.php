<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactFormController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'     => 'required|string|max:255',
            'no_telepon'       => 'required|string|max:20',
            'email'            => 'required|email',
            'jenis_kebutuhan'  => 'required|in:Pelayanan Administrasi,Pengaduan Masyarakat,Permintaan Informasi,Lainnya',
            'pesan'            => 'required|string'
        ]);

        ContactForm::create($validated);

        return back()->with('success', 'Pesan berhasil dikirim!');
    }

    public function index()
    {
        $data = ContactForm::latest()->paginate(10);
        return view('admin.form-kontak.index', compact('data'));
    }

    public function destroy($id)
    {
        $contact = ContactForm::findOrFail($id);
        $contact->delete();

        return back()->with('success', 'Data formulir kontak berhasil dihapus.');
    }

    // Show detail (for AJAX request)
   public function show($id)
{
    $contact = ContactForm::findOrFail($id);
    return view('admin.form-kontak.show', compact('contact'));
}
}
