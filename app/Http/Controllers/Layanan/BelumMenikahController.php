<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BelumMenikahController extends Controller
{
    public function create()
    {
        return view('user.layanan.belum-menikah.create');
    }
}
