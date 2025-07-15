<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengantarSkckController extends Controller
{
      public function index()
    {
        return view('admin.layanan.skck.index');
    }
    public function create()
    {
        return view('user.layanan.pengantar-skck.create');
    }

     public function store(Request $request)
    {

    }
}
