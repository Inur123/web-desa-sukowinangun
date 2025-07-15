<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PenghasilanController extends Controller
{
    public function create()
    {
        return view('user.layanan.penghasilan.create');
    }
      public function store(Request $request)
    {

    }
}
