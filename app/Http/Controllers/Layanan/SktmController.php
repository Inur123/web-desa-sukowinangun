<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SktmController extends Controller
{
    public function create()
    {
        return view('user.layanan.sktm.create');
    }
    public function store(Request $request)
    {

    }
}
