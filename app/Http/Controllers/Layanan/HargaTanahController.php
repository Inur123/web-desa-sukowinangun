<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HargaTanahController extends Controller
{
    public function create()
    {
        return view('user.layanan.harga-tanah.create');
    }

     public function store(Request $request)
    {

    }
}
