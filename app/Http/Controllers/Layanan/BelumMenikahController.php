<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BelumMenikahController extends Controller
{
    public function index()
    {
        return view('admin.layanan.belum-menikah.index');
    }
    public function create()
    {
        return view('user.layanan.belum-menikah.create');
    }

     public function store(Request $request)
    {

    }
}
