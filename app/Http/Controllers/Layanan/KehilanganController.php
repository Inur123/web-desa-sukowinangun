<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KehilanganController extends Controller
{
    public function create()
    {
        return view('user.layanan.kehilangan.create');
    }

     public function store(Request $request)
    {

    }
}
